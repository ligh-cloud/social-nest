<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class NotificationController extends Controller
{
    /**
     * Get all notifications for the authenticated user
     */
    public function index()
    {
        $user = auth()->user();
        $notifications = $user->notifications()->paginate(15);

        return view('notifications.index', compact('notifications'));
    }

    /**
     * Get unread notifications for the authenticated user
     */
    public function getUnread()
    {
        $notifications = auth()->user()->unreadNotifications;

        return response()->json([
            'notifications' => $notifications
        ]);
    }

    /**
     * Mark all notifications as seen
     * (Different from read - seen means user has viewed them in the dropdown)
     */
    public function markAsSeen()
    {
        $user = auth()->user();

        // We're not marking them as read, just updating a "seen_at" timestamp
        // so we know user has seen them in the dropdown
        foreach ($user->unreadNotifications as $notification) {
            $notification->data = array_merge($notification->data, ['seen_at' => now()]);
            $notification->save();
        }

        return response()->json(['success' => true]);
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead()
    {
        $user = auth()->user();
        $user->unreadNotifications->markAsRead();

        return response()->json(['success' => true]);
    }

    /**
     * Toggle read status of a specific notification
     */
    public function toggleRead($id)
    {
        $user = auth()->user();
        $notification = $user->notifications()->findOrFail($id);

        if ($notification->read_at) {
            // Mark as unread
            $notification->read_at = null;
            $notification->save();

            return response()->json([
                'success' => true,
                'read' => false
            ]);
        } else {
            // Mark as read
            $notification->markAsRead();

            return response()->json([
                'success' => true,
                'read' => true
            ]);
        }
    }
}
