<?php

namespace App\Http\Controllers;


use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\FriendPosted;
class PostController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $perPage = $request->input('per_page', 5);
        $page = $request->input('page', 1);

        $posts = Post::with(['user', 'comments.user'])
            ->withCount('comments')
            ->withCount('likes')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);


        if ($request->ajax()) {
            $view = view('partials.posts', compact('posts', 'user'))->render();
            return response()->json(['html' => $view]);
        }

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
            'media' => 'nullable|image|max:20480',
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

        // Check privacy
        if ($post->privacy === 'friends' || $post->privacy === 'public') {
            $friends = Auth::user()->friend;

            // Debugging: Ensure we have friends
            if ($friends->isEmpty()) {
                \Log::info('No friends found for user: ' . Auth::id());
            } else {
                \Log::info('Friends found for user: ' . Auth::id());
            }

            // Loop through the friends
            foreach ($friends as $friend) {
                // Debugging: Check if we are notifying the friend
                \Log::info('Notifying friend ID: ' . $friend->id);

                // Send the notification
                $friend->notify(new FriendPosted($post));
            }
        }

        return redirect()->back()->with('success', 'Post created.');
    }


    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
    public function showPost($id)
    {
        $user = Auth::user();
        $post = Post::with(['user', 'likes', 'comments.user'])->findOrFail($id);

        // Get the comments for this post, sorted by newest first
        $comments = $post->comments()->with('user')->latest()->get();

        // Check if the current user has liked this post
        $userLiked = false;
        if (auth()->check()) {
            $userLiked = $post->likes()->where('user_id', auth()->id())->exists();
        }

        return view('posts.show', compact('post', 'comments', 'userLiked' , 'user'));
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
    public function showVideos()
    {
        $videoExtensions = ['mp4', 'mov', 'avi', 'mkv'];

        $videoPosts = Post::whereNotNull('image')
        ->where(function($query) use ($videoExtensions) {
            foreach ($videoExtensions as $ext) {
                $query->orWhere('image', 'like', "%.{$ext}");
            }
        })
            ->latest()
            ->get();

        return view('videos.index', compact('videoPosts'));
    }
}
