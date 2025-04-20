<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function index()
    {
        // Fetch users with pagination
        $users = User::withTrashed()
            ->latest()
            ->paginate(10);

        // Fetch posts with their relationships
        $posts = Post::with(['user', 'likes'])
            ->withTrashed() // Include soft-deleted posts
            ->latest()
            ->paginate(10);
        
        // Get statistics
        $stats = [
            'total_users' => User::count(),
            'active_users' => User::where('last_active_at', '>=', Carbon::now()->subDay())->count(),
            'total_posts' => Post::count(),
            'banned_users' => User::onlyTrashed()->count(),
            'suspended_users' => User::where('suspended_until', '>', now())->count(),
        ];

        return view('admin.admin', compact('users', 'posts', 'stats'));
    }

    /**
     * Ban a user (AJAX)
     */
    public function banUser(Request $request, $userId)
    {
        try {
            $user = User::findOrFail($userId);
            $user->delete(); // Soft delete for ban

            return response()->json([
                'success' => true,
                'message' => 'User has been banned successfully',
                'user_id' => $user->id,
                'action' => 'ban'
            ]);
        } catch (\Exception $e) {
            Log::error("Error banning user: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to ban user: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Unban a user (AJAX)
     */
    public function unbanUser(Request $request, $userId)
    {
        try {
            $user = User::withTrashed()->findOrFail($userId);
            $user->restore();

            return response()->json([
                'success' => true,
                'message' => 'User has been unbanned successfully',
                'user_id' => $user->id,
                'action' => 'unban'
            ]);
        } catch (\Exception $e) {
            Log::error("Error unbanning user: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to unban user'
            ], 500);
        }
    }

    /**
     * Suspend a user (AJAX)
     */
    public function suspendUser(Request $request, $userId)
    {
        try {
            $user = User::findOrFail($userId);
            $days = $request->input('days', 7); // Default 7 days suspension
            $user->update([
                'suspended_until' => Carbon::now()->addDays($days)
            ]);

            return response()->json([
                'success' => true,
                'message' => 'User has been suspended successfully',
                'user_id' => $user->id,
                'action' => 'suspend'
            ]);
        } catch (\Exception $e) {
            Log::error("Error suspending user: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to suspend user: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Unsuspend a user (AJAX)
     */
    public function unsuspendUser(Request $request, $userId)
    {
        try {
            $user = User::findOrFail($userId);
            $user->update([
                'suspended_until' => null
            ]);

            return response()->json([
                'success' => true,
                'message' => 'User has been unsuspended successfully',
                'user_id' => $user->id,
                'action' => 'unsuspend'
            ]);
        } catch (\Exception $e) {
            Log::error("Error unsuspending user: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to unsuspend user: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get user statistics (AJAX)
     */
    public function getUserStats()
    {
        try {
            $stats = [
                'total_users' => User::count(),
                'active_users' => User::where('last_active_at', '>=', Carbon::now()->subDay())->count(),
                'banned_users' => User::onlyTrashed()->count(),
                'suspended_users' => User::where('suspended_until', '>', now())->count(),
                'new_users_today' => User::where('created_at', '>=', Carbon::today())->count(),
                'new_users_week' => User::where('created_at', '>=', Carbon::now()->subWeek())->count(),
                'new_users_month' => User::where('created_at', '>=', Carbon::now()->subMonth())->count(),
            ];

            return response()->json([
                'success' => true,
                'stats' => $stats
            ]);
        } catch (\Exception $e) {
            Log::error("Error getting user stats: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to get user statistics'
            ], 500);
        }
    }

    /**
     * Get post statistics (AJAX)
     */
    public function getPostStats()
    {
        try {
            $stats = [
                'total_posts' => Post::count(),
                'posts_today' => Post::where('created_at', '>=', Carbon::today())->count(),
                'posts_week' => Post::where('created_at', '>=', Carbon::now()->subWeek())->count(),
                'posts_month' => Post::where('created_at', '>=', Carbon::now()->subMonth())->count(),
                'average_posts_per_user' => Post::count() / max(User::count(), 1),
            ];

            return response()->json([
                'success' => true,
                'stats' => $stats
            ]);
        } catch (\Exception $e) {
            Log::error("Error getting post stats: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to get post statistics'
            ], 500);
        }
    }

    /**
     * Archive a post (AJAX)
     */
    public function archivePost(Request $request, Post $post)
    {
        try {
            $post->update(['archived' => true]);

            return response()->json([
                'success' => true,
                'message' => 'Post has been archived successfully',
                'post_id' => $post->id,
                'action' => 'archive'
            ]);
        } catch (\Exception $e) {
            Log::error("Error archiving post: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to archive post'
            ], 500);
        }
    }

    /**
     * Unarchive a post (AJAX)
     */
    public function unarchivePost(Request $request, Post $post)
    {
        try {
            $post->update(['archived' => false]);

            return response()->json([
                'success' => true,
                'message' => 'Post has been unarchived successfully',
                'post_id' => $post->id,
                'action' => 'unarchive'
            ]);
        } catch (\Exception $e) {
            Log::error("Error unarchiving post: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to unarchive post'
            ], 500);
        }
    }

    /**
     * Delete a post (AJAX)
     */
    public function deletePost(Request $request, $postId)
    {
        try {
            $post = Post::findOrFail($postId);
            $post->delete(); // Soft delete the post

            return response()->json([
                'success' => true,
                'message' => 'Post has been deleted successfully',
                'post_id' => $post->id,
                'action' => 'delete'
            ]);
        } catch (\Exception $e) {
            Log::error("Error deleting post: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete post: ' . $e->getMessage()
            ], 500);
        }
    }
}
