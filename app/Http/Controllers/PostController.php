<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user', 'comments', 'likes', 'media')->latest()->get();
        return view('post.index', compact('posts'));
    }

    public function store(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'body' => 'required|string',
                'location' => 'nullable|string|max:255',
            ]);


            $post = Post::create([
                'user_id' => auth()->id(),
                'title' => $validatedData['title'],
                'body' => $validatedData['body'],
                'location' => $validatedData['location'],
            ]);

            if ($request->hasFile('media') && $request->file('media')->isValid()) {
                $file = $request->file('media');

                $fileName = time() . '_' . $file->getClientOriginalName();


                $filePath = $file->move(public_path('posts'), $fileName);


                $isImage = in_array($file->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif']);


                Media::create([
                    'post_id' => $post->id,
                    'path' => 'posts/' . $fileName,
                    'is_image' => $isImage,
                ]);
            }


            return response()->json([
                'message' => 'Post created successfully',
                'post_id' => $post->id
            ]);

        } catch (\Exception $e) {

            Log::error('Error creating post: ' . $e->getMessage(), [
                'exception' => $e,
                'request_data' => $request->all(),
                'user_id' => auth()->id(),
            ]);


            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $post = Post::findOrFail($id);


            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'body' => 'required|string',
                'location' => 'nullable|string|max:255',
            ]);


            $post->update([
                'title' => $validatedData['title'],
                'body' => $validatedData['body'],
                'location' => $validatedData['location'],
            ]);


            if ($request->hasFile('media') && $request->file('media')->isValid()) {
                $file = $request->file('media');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->move(public_path('posts'), $fileName);


                $isImage = in_array($file->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif']);

                $existingMedia = $post->media;
                if ($existingMedia) {

                    $existingMedia->update([
                        'path' => 'posts/' . $fileName,
                        'is_image' => $isImage,
                    ]);
                } else {

                    Media::create([
                        'post_id' => $post->id,
                        'path' => 'posts/' . $fileName,
                        'is_image' => $isImage,
                    ]);
                }
            }

            return response()->json(['message' => 'Post updated successfully'], 200);

        } catch (\Exception $e) {
            Log::error('Error updating post: ' . $e->getMessage(), [
                'exception' => $e,
                'request_data' => $request->all(),
                'user_id' => auth()->id(),
            ]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $post = Post::findOrFail($id);
            if ($post->media) {
                $mediaPath = public_path($post->media->path);
                if (file_exists($mediaPath)) {
                    unlink($mediaPath);
                }
                $post->media->delete();
            }
            $post->delete();

            return response()->json(['message' => 'Post deleted successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting post: ' . $e->getMessage());
            return response()->json(['error' => 'Error deleting the post'], 500);
        }
    }

}
