<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $userId = Auth::id();
        $friends = Friendship::where(function ($query) use ($userId) {
            $query->where('sender_id' , $userId)
                ->orWhere('receiver_id' , $userId);
        })->get();
        return view('user.friends', compact('friends', 'user'));
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
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
        ]);

        $senderId = Auth::id();
        $receiverId = $request->receiver_id;

        // Prevent duplicate or self-requests
        if ($senderId == $receiverId || Friendship::where([
                ['sender_id', $senderId],
                ['receiver_id', $receiverId],
            ])->orWhere([
                ['sender_id', $receiverId],
                ['receiver_id', $senderId],
            ])->exists()) {
            return back()->with('error', 'Friend request already exists or invalid.');
        }

        Friendship::create([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Friend request sent.');
    }

    /**
     * Display the specified resource.
     */
    public function showLatest()
    {
        $user = Auth::user();
        $friendRequests = Friendship::where('receiver_id' , $user->id)

            ->latest()
            ->take(2)
            ->with('sender')
            ->get();
        return view('user.friends', compact('friendRequests'));
    }

    public function getRequests($status)
    {
        $user = Auth::user();

        $query = Friendship::where('receiver_id', $user->id)

            ->Where('status' , $status)
            ->with('sender')
            ->latest()
            ->get();

        $friendRequests = $query->get();
        return view('partials.friend_requests', compact('friendRequests'))->render();
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Friendship $friendship)
    {
        $userId = Auth::id();

        if ($friendship->receiver_id != $userId) {
            abort(403, 'Unauthorized action.');
        }

        $friendship->update([
            'status' => 'accepted',
        ]);

        return back()->with('success', 'Friend request accepted.');
    }



    public function destroy(Friendship $friendship)
{
    $userId = Auth::id();

    // Only sender or receiver can delete
    if ($friendship->sender_id !== $userId && $friendship->receiver_id !== $userId) {
        abort(403, 'Unauthorized action.');
    }

    $friendship->delete();

    return back()->with('success', 'Friendship removed or request refused.');
}
}
