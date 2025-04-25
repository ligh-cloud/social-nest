<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SavedController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\Auth\FacebookController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsArchived;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', IsAdmin::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    // User Management Routes
    Route::post('/admin/users/{userId}/ban', [AdminController::class, 'banUser'])->name('admin.users.ban');
    Route::post('/admin/users/{userId}/unban', [AdminController::class, 'unbanUser'])->name('admin.users.unban');
    Route::post('/admin/users/{userId}/suspend', [AdminController::class, 'suspendUser'])->name('admin.users.suspend');
    Route::post('/admin/users/{userId}/unsuspend', [AdminController::class, 'unsuspendUser'])->name('admin.users.unsuspend');

    // Post Management Routes
    Route::post('/admin/posts/{postId}/delete', [AdminController::class, 'deletePost'])->name('admin.posts.delete');

    // Statistics Routes
    Route::get('/admin/stats/users', [AdminController::class, 'getUserStats'])->name('admin.stats.users');
    Route::get('/admin/stats/posts', [AdminController::class, 'getPostStats'])->name('admin.stats.posts');
});

/*
|--------------------------------------------------------------------------
| Authenticated, Verified & Not Archived User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', IsArchived::class, IsAdmin::class])->group(function () {

    // Home & Posts
    Route::get('/home', [\App\Http\Controllers\PostController::class, 'index'])->name('home');
    Route::post('/posts', [\App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}', [App\Http\Controllers\PostController::class, 'showPost'])->name('posts.show');
    Route::post('/post/like', [LikeController::class, 'store'])->name('posts.like');

    // Static Pages
    Route::view('/watch', 'watch')->name('watch');
    Route::view('/memories', 'memories')->name('memories');
    Route::view('/pages', 'pages')->name('pages');
    Route::view('/events', 'events')->name('events');
    Route::view('/settings', 'settings')->name('settings');

    // User Settings & Other Views
    Route::view('user/settings', 'user.settings')->name('user.settings');
    Route::view('/notifications', 'user.notification')->name('notifications');
    Route::view('/posts/saved', 'user.saved')->name('posts.saved');
    Route::view('/posts/watch', 'user.watch')->name('posts.watch');


    // Friends System
    Route::get('/friends', [FriendshipController::class, 'index'])->name('friends');
    Route::post('/friends', [FriendshipController::class, 'store']);
    Route::put('/friends/{friendship}', [FriendshipController::class, 'update'])->name('friends.update');
    Route::delete('/friends/{friendship}', [FriendshipController::class, 'destroy'])->name('friends.destroy');
    Route::get('/friends/show/{status}', [FriendshipController::class, 'getRequests'])->name('friends.show');
    Route::get('/friends/suggestions', [FriendshipController::class, 'showSuggestions'])->name('friends.suggestions');

    // Chat system
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/messages', [ChatController::class, 'messages'])->name('messages');
    Route::get('/chat/{user}', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/{user}', [ChatController::class, 'sendMessage'])->name('chat.send');

    //Saved system
    Route::get('/saved-posts', [SavedController::class, 'index'])->name('saved.index');
    Route::post('/posts/{post}/save', [SavedController::class, 'store'])->name('saved.store');
    Route::delete('/posts/{post}/unsave', [SavedController::class, 'destroy'])->name('saved.destroy');


    // Notification routes
    Route::get('/notifications/unread', 'NotificationController@getUnread');
    Route::post('/notifications/mark-as-seen', 'NotificationController@markAsSeen');
    Route::post('/notifications/mark-all-as-read', 'NotificationController@markAllAsRead');
    Route::post('/notifications/{id}/toggle-read', 'NotificationController@toggleRead');
    Route::get('/notifications', 'NotificationController@index')->name('notifications.index');

    //comments system
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    // Logout
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/')->with('message', 'Logged out successfully.');
    })->name('logout');

    //the notification views and logic
    Route::get('/notifications', [NotificationController::class, 'getUnread'])->name('notifications.index');
//    Route::get('notifications/unread', [NotificationController::class, 'getUnread']);
    Route::get('/notifications/get-unread', [NotificationController::class, 'getUnread']);
    Route::post('/notifications/mark-as-seen', [NotificationController::class, 'markAsSeen']);
//    Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
//    Route::post('/notifications/{id}/mark-read', [NotificationController::class, 'markOneAsRead'])->name('notifications.markOneAsRead');
});





/*
|--------------------------------------------------------------------------
| Email Verification Routes
|--------------------------------------------------------------------------
*/
Route::get('/email/verify', fn() => view('auth.verify-email'))->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home')->with('success', 'Email verified successfully.');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

/*
|--------------------------------------------------------------------------
| Public Routes (Login, Register, Password)
|--------------------------------------------------------------------------
*/
Route::view('/', 'welcome')->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('password', fn() => 'Password reset page.')->name('password.request');

/*
|--------------------------------------------------------------------------
| OAuth Routes (Google & Facebook)
|--------------------------------------------------------------------------
*/
Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('auth.google.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('auth.google.callback');

Route::get('login/facebook', [FacebookController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);

/*
|--------------------------------------------------------------------------
| Extra
|--------------------------------------------------------------------------
*/
Route::get('/saved', fn() => 'this is the saved page')->name('saved');

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
});
