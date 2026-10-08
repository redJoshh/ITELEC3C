<?php

namespace App\Http\Controllers;
use App\Models\Post;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('dashboard', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
    public function create()
    {
        return view('posts.create');
    }
    public function submit(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|min:10|max:255',
            'body' => 'required|string|min:20',
        ]);

        $request->user()->posts()->create($validatedData);

        return redirect()->route('posts.create')
            ->with('success', 'Your post has been submitted!');
    }
}
