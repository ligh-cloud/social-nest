<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Saved;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavedController extends Controller
{
    public function savedPosts(){
        $savedPosts = Auth::user()->savedPosts()->user()->latest()->get();
        return view('saved-posts', compact('savedPosts'));
    }

    public function save(Post $post)
    {
        auth()->user()->savedPosts()->attach($post->id);

        return redirect()->back()->with('success', 'Post saved successfully!');
    }

    public function unsave(Post $post)
    {
        auth()->user()->savedPosts()->detach($post->id);

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
