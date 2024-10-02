<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

    public function destroy($id)
    {
        try {
            // Try to find the comment by ID
            $comment = Comment::findOrFail($id);

            // Delete the comment
            $comment->delete();

            return response()->json(['message' => 'Comment deleted successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Comment not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error deleting comment'], 500);
        }
    }

}
