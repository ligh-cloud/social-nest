<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $posts = Post::latest()
            ->withCount('likes')
            ->get();

        return view('user.home', compact('posts', 'user'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'nullable|string',
            'media' => 'nullable|image',
            'privacy' => 'required|in:public,friends,private'
        ]);

        $imagePath = null;


        if ($request->hasFile('media')) {
            $imagePath = $request->file('media')->store('posts', 'public');
        }

        $post = Post::create([
            'user_id' => Auth::id(),
            'text' => $request->text,
            'image' => $imagePath,
            'privacy' => $request->privacy,
        ]);

        if ($post->privacy === 'friends' || $post->privacy === 'public') {

            $friends = Auth::user()->friends();

            foreach ($friends as $friend) {

                Notification::create([

                    'type' => 'post',
                    'notifiable_id' => $post->id,
                    'notifiable_type' => Post::class,
                    'read' => false,
                    'actor_id' => $friend->id,
                    'message' => $friend->name . "created a post",

                ]);
            }
        }

        return redirect()->back()->with('success', 'Post created.');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'nullable|string',
            'media' => 'nullable|image|mimes:jpg,jpeg,png',
            'privacy' => 'required|in:public,friends,private',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $post->image = $imagePath;
        }

        $post->update([
            'content' => $request->text,
            'privacy' => $request->privacy,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted.');
    }
}
