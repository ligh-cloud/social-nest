<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Saved;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavedController extends Controller
{
    public function savedPosts()
    {

        $user = Auth::user();
        $savedPosts = Auth::user()->savedPosts()->latest()->paginate(10);
        return view('user.saved-posts', compact('savedPosts' , 'user'));
    }
    public function save(Post $post)
    {
        $user = Auth::user();

        // Check if the post is already saved
        if (!$user->savedPosts->contains($post->id)) {
            $user->savedPosts()->attach($post->id);
            return redirect()->back()->with('success', 'Post saved successfully!');
        }

        return redirect()->back()->with('info', 'Post was already saved.');
    }
    public function unsave(Post $post)
    {
        auth()->user()->savedPosts()->attach($post->id);

        return redirect()->back()->with('success', 'Post unsaved successfully!');
    }


//    public function index()
//    {
//        $savedPosts = Auth::user()
//            ->savedPosts()
//            ->with('user') // optional: get post's owner
//            ->latest()
//            ->get();
//
//        return view('saved.index', compact('savedPosts'));
//    }
//
//    public function store(Post $post)
//    {
//        $exists = Saved::where('user_id', Auth::id())
//            ->where('post_id', $post->id)
//            ->exists();
//
//        if (!$exists) {
//            Saved::create([
//                'user_id' => Auth::id(),
//                'post_id' => $post->id
//            ]);
//        }
//
//        return back()->with('success', 'Post saved!');
//    }
//
//    public function destroy(Post $post)
//    {
//        Saved::where('user_id', Auth::id())
//            ->where('post_id', $post->id)
//            ->delete();
//
//        return back()->with('success', 'Post unsaved!');
//    }
}
