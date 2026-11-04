<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Alignment;
use Intervention\Image\Format;
use Intervention\Image\Laravel\Facades\Image;


class PostController extends Controller
{
    //
    public function index()
    {
        $posts = Post::latest()->orderByDesc('id')->paginate(10);
        return view('admin.dashboard', compact('posts'));
    }

    public function showPost(Post $post)
    {
        return view('admin.posts.show', compact('post'));
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
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:3072'
        ]);

        $request->user()->posts()->create([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'image_path' => $this->saveWatermarkedImage($request->file('image')),
        ]);



        return redirect()->route('admin.posts.index')
            ->with('success', 'Post with watermark created successfully.');
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
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',

        ]);

        $post->title = $validated['title'];
        $post->body = $validated['body'];

        $oldImage = null;
        $newImage = null;

        if ($request->hasFile('image')) {
            $newImage = $this->saveWatermarkedImage($request->file('image'));
            $oldImage = $post->image_path;
            $post->image_path = $newImage;
        }

        try {
            $post->save();
        } catch (\Throwable $e) {
            if ($newImage) {
                Storage::disk('public')->delete($newImage);
            }
            throw $e;
        }

        if ($oldImage) {
            Storage::disk('public')->delete($oldImage);
        }

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

    public function restore(int $id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();

        return redirect()->route('admin.posts.archived')
            ->with('success', 'Post restored successfully.');
    }

    public function forceDelete(int $id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->forceDelete();

        return redirect()->route('admin.posts.archived')
            ->with('success', 'Post permanently deleted.');
    }

    private function saveWatermarkedImage(UploadedFile $file)
    {
        $image = Image::decode($file);
        $image->scaleDown(width: 1000);

        $watermarkPath = public_path('images/watermark.png');
        if (!is_file($watermarkPath)) {
            throw new \RuntimeException(
                "Watermark not found: public/images/watermark.png"
            );
        }
        $watermark = Image::decode($watermarkPath);
        $watermarkWidth = min(180, max(1, (int) ($image->width() * 0.25)));
        $watermark->scaleDown(width: $watermarkWidth);

        $image->insert(
            $watermark,
            12,
            12,
            Alignment::BOTTOM_RIGHT,
            0.55
        );
        $path = "posts/" . Str::uuid() . ".webp";
        $encoded = $image->encodeUsingFormat(Format::WEBP, quality: 80);

        if (!Storage::disk('public')->put($path, (string) $encoded)) {
            throw new \RuntimeException("Failed to save image.");
        }
        return $path;
    }
}
