<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contents = \App\Models\WebsiteContent::latest()->get();
        return view('website-contents.index', compact('contents'));
    }

    public function create()
    {
        return view('website-contents.create');
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'key' => 'required|string|unique:website_contents,key',
            'title' => 'required|string',
            'content' => 'nullable|string',
            'category' => 'required|string',
        ]);

        \App\Models\WebsiteContent::create($data);

        return redirect()->route('website-contents.index')->with('success', 'Konten Website ditambahkan.');
    }

    public function edit(\App\Models\WebsiteContent $websiteContent)
    {
        return view('website-contents.edit', compact('websiteContent'));
    }

    public function update(\Illuminate\Http\Request $request, \App\Models\WebsiteContent $websiteContent)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'content' => 'nullable|string',
            'category' => 'required|string',
        ]);

        $websiteContent->update($data);

        return redirect()->route('website-contents.index')->with('success', 'Konten diperbarui.');
    }

    public function destroy(\App\Models\WebsiteContent $websiteContent)
    {
        $websiteContent->delete();
        return redirect()->route('website-contents.index')->with('success', 'Konten dihapus.');
    }
}
