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
        Comment::create([
            'post_id' => $post->id,
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Comment posted successfully!');
    }
}
