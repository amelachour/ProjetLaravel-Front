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

        return view('post.index',
            compact('posts'));
    }

    public function store(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'body' => 'required|string', // Matches 'body' input from the form
                'location' => 'nullable|string|max:255',
                'media' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,mov,avi|max:10240', // Add validation for media
            ]);

            // Create a new post
            $post = Post::create([
                'user_id' => auth()->id(),
                'title' => $validatedData['title'],
                'body' => $validatedData['body'],
                'location' => $validatedData['location'],
            ]);

            // Handle the media file, if it exists
            if ($request->hasFile('media') && $request->file('media')->isValid()) {
                $file = $request->file('media');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->move(public_path('posts'), $fileName);

                // Determine if the uploaded file is an image
                $isImage = in_array($file->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif']);

                // Save media details
                Media::create([
                    'post_id' => $post->id,
                    'path' => 'posts/' . $fileName,
                    'is_image' => $isImage,
                ]);
            }

            // Return success response
            return response()->json([
                'message' => 'Post created successfully',
                'post_id' => $post->id
            ]);

        } catch (\Exception $e) {
            // Log error details for debugging
            Log::error('Error creating post: ' . $e->getMessage(), [
                'exception' => $e,
                'request_data' => $request->all(),
                'user_id' => auth()->id(),
            ]);

            // Return error response
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'body' => 'required|string',
                'location' => 'nullable|string|max:255',
                'media' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,mov,avi|max:10240'
            ]);

            $post = Post::findOrFail($id);

            // Update Post details
            $post->update([
                'title' => $validatedData['title'],
                'body' => $validatedData['body'],
                'location' => $validatedData['location'],
            ]);

            // Handle Media
            if ($request->hasFile('media') && $request->file('media')->isValid()) {
                $file = $request->file('media');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->move(public_path('posts'), $fileName);
                $isImage = in_array($file->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif']);

                if ($post->media) {
                    // Delete old media if exists
                    if (file_exists(public_path($post->media->path))) {
                        unlink(public_path($post->media->path));
                    }
                    $post->media->update([
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
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error updating post: ' . $e->getMessage(), [
                'exception' => $e,
                'request_data' => $request->all(),
                'user_id' => auth()->id(),
            ]);

            return response()->json(['error' => 'Error updating the post'], 500);
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
