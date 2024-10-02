<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        // Validate the incoming request
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        // Create a new comment
        $comment = Comment::create([
            'post_id' => $post->id,
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);

        // Return a JSON response for AJAX
        return response()->json([
            'user' => auth()->user()->name,
            'comment' => $comment->comment,
            'created_at' => $comment->created_at->diffForHumans()
        ]);
    }

    public function destroy(Comment $comment)
    {
        // Ensure the user is authorized to delete the comment
        if ($comment->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Delete the comment
        $comment->delete();

        // Return a JSON response
        return response()->json(['message' => 'Comment deleted successfully']);
    }

}
