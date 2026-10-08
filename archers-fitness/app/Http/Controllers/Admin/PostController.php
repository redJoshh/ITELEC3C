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
        $posts = Post::latest()->orderByDesc('id')->paginate(10);
        return view('admin.dashboard', compact('posts'));
    }
    public function create()
    {
        return view("admin.posts.create");
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|min:10|max:255',
            'body' => 'required|string|min:20',
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
            'title' => 'required|string|min:10|max:255',
            'body' => 'required|string|min:20',
        ]);

        $post->update($validated);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post updated successfully.');
    }
    public function archive(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Post archived successfully.');
    }
    public function archived()
    {
        $posts = Post::onlyTrashed()->latest('deleted_at')->paginate(10);
        return view('admin.posts.archived', compact('posts'));
    }

    public function restore($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();

        return redirect()->route('admin.posts.archived')
            ->with('success', 'Post restored successfully.');
    }

    public function forceDelete($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->forceDelete();

        return redirect()->route('admin.posts.archived')
            ->with('success', 'Post permanently deleted.');
    }
}
