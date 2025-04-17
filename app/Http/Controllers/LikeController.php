<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post_id = $request->post_id;
        $userId = Auth::id();
        $like = Like::where('post_id' , $post_id)->where('user_id', $userId)->first();
        if($like){
            $like->delete();
            $liked = false;
        }
        else{
            Like::create([
                'post_id' => $post_id,
                'user_id' => $userId,
            ]);
            $liked = true;
        }
        $count = Post::find($post_id)->likes()->count();
        return response()->json([
            'liked' => $liked,
            'count' => $count,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Like $like)
    {
        //
    }
}
