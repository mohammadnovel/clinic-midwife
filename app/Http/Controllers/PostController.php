<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category', 'author')->latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'excerpt'     => 'nullable|string|max:500',
            'content'     => 'required|string',
            'status'      => 'required|in:draft,published',
            'thumbnail'   => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['title', 'category_id', 'excerpt', 'content', 'status']);
        $data['slug']    = Str::slug($request->title) . '-' . Str::random(4);
        $data['user_id'] = Auth::id();

        if ($request->status === 'published') {
            $data['published_at'] = now();
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('posts', 'public');
        }

        Post::create($data);

        return redirect()->route('posts.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::orderBy('name')->get();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'excerpt'     => 'nullable|string|max:500',
            'content'     => 'required|string',
            'status'      => 'required|in:draft,published',
            'thumbnail'   => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['title', 'category_id', 'excerpt', 'content', 'status']);

        if ($request->status === 'published' && !$post->published_at) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('posts.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Artikel berhasil dihapus.');
    }

    public function publicIndex()
    {
        $posts = Post::with('category', 'author')
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(9);
        $categories = Category::withCount(['posts' => fn($q) => $q->where('status', 'published')])->get();
        return view('blog.index', compact('posts', 'categories'));
    }

    public function publicShow(string $slug)
    {
        $post = Post::with('category', 'author')->where('slug', $slug)->where('status', 'published')->firstOrFail();
        $related = Post::with('category')
            ->where('status', 'published')
            ->where('id', '!=', $post->id)
            ->where('category_id', $post->category_id)
            ->latest('published_at')
            ->limit(3)
            ->get();
        return view('blog.show', compact('post', 'related'));
    }
}
