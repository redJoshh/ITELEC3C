<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index()
    {
        $posts = Post::all();
        return view('admin.dashboard', compact('posts'));
    }
    public function create()
    {
        return view("admin.posts.create");
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string'
        ]);
        $request->user()->posts()->create($validatedData);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post created successfully.');
    }
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact("post"));
    }
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $post->update($validated);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post updated successfully.');
    }
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Post deleted successfully.');
    }
}
