<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Get all notifications for the authenticated user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|object
     */
    public function index()
    {
        // Paginate notifications (10 per page)
        $notifications = Auth::user()->notifications()->paginate(10);

        // Return the view with notifications
        return view('notifications.index', compact('notifications'));
    }

    /**
     * Mark all unread notifications as read
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function markAsRead()
    {
        // Efficiently mark unread notifications as read in the database
        Auth::user()->unreadNotifications()->update(['read_at' => now()]);

        // Return a success response
        return response()->json(['success' => true]);
    }

    /**
     * Mark a specific notification as read
     *
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markOneAsRead($id)
    {
        // Find the specific notification by ID
        $notification = Auth::user()->notifications()->where('id', $id)->first();

        // If notification exists, mark as read
        if ($notification) {
            $notification->markAsRead();
            return redirect()->back()->with('success', 'Notification marked as read');
        }

        // If notification doesn't exist, return an error message
        return redirect()->back()->with('error', 'Notification not found');
    }
}
