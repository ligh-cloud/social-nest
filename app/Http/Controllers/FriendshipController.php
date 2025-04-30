<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;
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

        // Check for existing friendship in either direction
        $existingFriendship = Friendship::where(function($query) use ($senderId, $receiverId) {
            $query->where('sender_id', $senderId)
                ->where('receiver_id', $receiverId);
        })->orWhere(function($query) use ($senderId, $receiverId) {
            $query->where('sender_id', $receiverId)
                ->where('receiver_id', $senderId);
        })->first();

        if ($senderId == $receiverId) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot send a friend request to yourself.'
            ], 422);
        }

        if ($existingFriendship) {
            $message = $existingFriendship->status === 'pending'
                ? 'Friend request already pending.'
                : 'You are already friends.';

            return response()->json([
                'success' => false,
                'message' => $message
            ], 422);
        }

        Friendship::create([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Friend request sent successfully!'
        ]);
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

        if ($status === 'accepted') {
            $friendRequests = Friendship::where(function ($query) use ($user) {
                $query->where('sender_id', $user->id)
                    ->orWhere('receiver_id', $user->id);
            })
                ->where('status', 'accepted')
                ->with(['sender', 'receiver'])
                ->latest()
                ->get();
        } else {
            // This is for 'pending' requests the user RECEIVED
            $friendRequests = Friendship::where('receiver_id', $user->id)
                ->where('status', $status)
                ->with('sender')
                ->latest()
                ->get();
        }

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


    public function showSuggestions()
    {
        $userId = Auth::id();
        $user = Auth::user();
        // Get all friend IDs (both sender and receiver) for the current user
        $friendIds = Friendship::where(function ($query) use ($userId) {
            $query->where('sender_id', $userId)
                ->orWhere('receiver_id', $userId);
        })->get()->flatMap(function ($friendship) use ($userId) {
            return [$friendship->sender_id, $friendship->receiver_id];
        })->unique()->values()->toArray();


        $friendIds[] = $userId;


        $suggestedUsers = User::whereNotIn('id', $friendIds)->get();

        if (request()->ajax()) {

            return view('partials.user_suggestions', compact('suggestedUsers'))->render();
        }

        // Return the full page for direct visits
        return view('partials.friend_suggestions', compact('suggestedUsers', 'user'));
    }
}
