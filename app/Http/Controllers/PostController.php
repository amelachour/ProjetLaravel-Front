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
            // Validate the incoming request
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'body' => 'required|string',
                'location' => 'nullable|string|max:255',
            ]);

            // Create the post
            $post = Post::create([
                'user_id' => auth()->id(),
                'title' => $validatedData['title'],
                'body' => $validatedData['body'],
                'location' => $validatedData['location'],
            ]);

            if ($request->hasFile('media') && $request->file('media')->isValid()) {
                $file = $request->file('media');

                $fileName = time() . '_' . $file->getClientOriginalName();

                // Move the file to the public/posts directory
                $filePath = $file->move(public_path('posts'), $fileName);

                // Determine if the file is an image
                $isImage = in_array($file->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif']);

                // Save the media information
                Media::create([
                    'post_id' => $post->id,
                    'path' => 'posts/' . $fileName,
                    'is_image' => $isImage,
                ]);
            }

            // Return a successful response with the post ID
            return response()->json([
                'message' => 'Post created successfully',
                'post_id' => $post->id
            ]);

        } catch (\Exception $e) {
            // Log detailed error information
            Log::error('Error creating post: ' . $e->getMessage(), [
                'exception' => $e,
                'request_data' => $request->all(),
                'user_id' => auth()->id(),
            ]);

            // Return the error message to the frontend
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $post = Post::findOrFail($id);

            // Validate the incoming request data
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'body' => 'required|string',
                'location' => 'nullable|string|max:255',
            ]);

            // Update the post
            $post->update([
                'title' => $validatedData['title'],
                'body' => $validatedData['body'],
                'location' => $validatedData['location'],
            ]);

            // Check for media and update or create as necessary
            if ($request->hasFile('media') && $request->file('media')->isValid()) {
                $file = $request->file('media');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->move(public_path('posts'), $fileName);

                // Determine if the file is an image
                $isImage = in_array($file->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif']);

                $existingMedia = $post->media;
                if ($existingMedia) {
                    // Update existing media record, do not delete the old file
                    $existingMedia->update([
                        'path' => 'posts/' . $fileName,
                        'is_image' => $isImage,
                    ]);
                } else {
                    // Create a new media record
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
                    unlink($mediaPath); // Delete the media file
                }
                $post->media->delete(); // Delete the media record
            }
            $post->delete(); // Delete the post

            return response()->json(['message' => 'Post deleted successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting post: ' . $e->getMessage());
            return response()->json(['error' => 'Error deleting the post'], 500);
        }
    }

}
