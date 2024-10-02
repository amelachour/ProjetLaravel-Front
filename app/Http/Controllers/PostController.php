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
                'media' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,mov,avi|max:10240',
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

                $filePath = $file->move(public_path('posts'), $fileName);

//                $isImage = strpos($file->getMimeType(), 'image') !== false;

                // Save the media information
                Media::create([
                    'post_id' => $post->id,
                    'path' => 'posts/' . $fileName,
                    'is_image' => 1,
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
}
