<?php

namespace App\Http\Controllers;
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
        $posts = Post::latest()->paginate(10);
        return view('dashboard', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function readMyPosts(Request $request)
    {
        $posts = $request->user()->posts()->latest()->orderByDesc('id')->paginate(10);
        return view('posts.user', compact('posts'));
    }
    public function create()
    {
        return view('posts.create');
    }
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:10|max:255',
            'body' => 'required|string|min:20',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $path = $this->saveWatermarkedImage($request->file('image'));

        try {
            $request->user()->posts()->create([
                'title' => $validated['title'],
                'body' => $validated['body'],
                'image_path' => $path,
            ]);
        } catch (\Throwable $e) {
            Storage::disk('public')->delete($path);
            throw $e;
        }

        return redirect()->route('posts.user')
            ->with('success', 'Your post with watermark has been submitted!');
    }

    public function edit(Request $request, int $id)
    {
        $post = $request->user()->posts()->findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, int $id)
    {
        $post = $request->user()->posts()->findOrFail($id);

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

        return redirect()->route('posts.user')
            ->with('success', 'Your post has been updated.');
    }




    public function destroy(Request $request, int $id)
    {
        $post = $request->user()->posts()->findOrFail($id);
        $post->delete();

        return redirect()->route('posts.user')
            ->with('success', 'Your post has been deleted.');
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
