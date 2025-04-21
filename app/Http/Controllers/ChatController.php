<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function messages()
    {
        try {
            $users = User::where('id', '!=', auth()->id())
                ->with(['lastMessage' => function($query) {
                    $query->where(function($q) {
                        $q->where('sender_id', auth()->id())
                          ->orWhere('receiver_id', auth()->id());
                    });
                }])
                ->get();

            return view('messages', [
                'users' => $users
            ]);
        } catch (\Exception $e) {
            Log::error('Messages view error: ' . $e->getMessage());
            return back()->with('error', 'Failed to load messages');
        }
    }

    public function index(User $user)
    {
        try {
            $messages = Chat::query()
                ->where(function ($query) use ($user) {
                    $query->where('sender_id', auth()->id())
                        ->where('receiver_id', $user->id);
                })
                ->orWhere(function ($query) use ($user) {
                    $query->where('sender_id', $user->id)
                        ->where('receiver_id', auth()->id());
                })
                ->with(['sender', 'receiver'])
                ->orderBy('created_at', 'asc')
                ->get();

            return view('chat', [
                'user' => $user,
                'messages' => $messages
            ]);
        } catch (\Exception $e) {
            Log::error('Chat view error: ' . $e->getMessage());
            return back()->with('error', 'Failed to load chat');
        }
    }

    public function show(User $user)
    {
        return view('chat', [
            'user' => $user
        ]);
    }

    public function sendMessage(Request $request, User $user)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'message' => 'required|string|max:1000'
            ]);

            $message = Chat::create([
                'sender_id' => auth()->id(),
                'receiver_id' => $user->id,
                'message' => $validated['message']
            ]);

            $message->load(['sender', 'receiver']);

            broadcast(new MessageSent($message))->toOthers();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => $message
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message sending failed: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send message: ' . $e->getMessage()
            ], 500);
        }
    }
}
