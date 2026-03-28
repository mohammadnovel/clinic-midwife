<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class BlogTest extends TestCase
{
    use RefreshDatabase;

    public function test_blog_index_loads(): void
    {
        $response = $this->get('/blog');

        $response->assertStatus(200);
    }

    public function test_blog_returns_only_published_posts(): void
    {
        $published = Post::create([
            'title'        => 'Published Article',
            'slug'         => Str::slug('Published Article') . '-test',
            'content'      => 'Some content here.',
            'status'       => 'published',
            'published_at' => now(),
        ]);

        Post::create([
            'title'   => 'Draft Article',
            'slug'    => Str::slug('Draft Article') . '-test',
            'content' => 'Draft content.',
            'status'  => 'draft',
        ]);

        $response = $this->get('/blog');

        $response->assertStatus(200);
        $response->assertSee('Published Article');
        $response->assertDontSee('Draft Article');
    }

    public function test_blog_show_returns_404_for_draft(): void
    {
        $slug = Str::slug('Draft Post') . '-test';

        Post::create([
            'title'   => 'Draft Post',
            'slug'    => $slug,
            'content' => 'Draft content.',
            'status'  => 'draft',
        ]);

        $response = $this->get('/blog/' . $slug);

        $response->assertStatus(404);
    }

    public function test_blog_show_returns_200_for_published(): void
    {
        $slug = Str::slug('Published Post') . '-test';

        Post::create([
            'title'        => 'Published Post',
            'slug'         => $slug,
            'content'      => 'Some content.',
            'status'       => 'published',
            'published_at' => now(),
        ]);

        $response = $this->get('/blog/' . $slug);

        $response->assertStatus(200);
    }
}
