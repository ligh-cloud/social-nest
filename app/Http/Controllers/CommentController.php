<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Remove the getForm method since you don't have partials

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'text' => 'required|string|max:1000',
        ]);

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'content' => $request->text,
        ]);

        // If this is an AJAX request, return JSON
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'comment_id' => $comment->id,
                'comments_count' => $post->comments()->count(),
                'can_delete' => Auth::user()->role_id == 1
            ]);
        }

        return back()->with('success', 'Comment added.');
    }

    public function destroy(Comment $comment)
    {
        $user = Auth::user();
        if ($user->role_id == 1){

            $comment->delete();

            return back()->with('success', 'Comment deleted.');
        }
        return "You are not allowed to delete this comment.";
    }
}
