<?php

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
    Route::post('/admin/users/{user}/ban', [AdminController::class, 'banUser'])->name('admin.users.ban');
    Route::post('/admin/users/{userId}/unban', [AdminController::class, 'unbanUser'])->name('admin.users.unban');
    Route::post('/admin/users/{user}/suspend', [AdminController::class, 'suspendUser'])->name('admin.users.suspend');
    Route::post('/admin/users/{user}/unsuspend', [AdminController::class, 'unsuspendUser'])->name('admin.users.unsuspend');
    
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

    // Logout
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/')->with('message', 'Logged out successfully.');
    })->name('logout');
});

/*
|--------------------------------------------------------------------------
| Email Verification Routes
|--------------------------------------------------------------------------
*/
Route::get('/email/verify', fn () => view('auth.verify-email'))->name('verification.notice');

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
Route::get('password', fn () => 'Password reset page.')->name('password.request');

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
Route::get('/saved', fn () => 'this is the saved page')->name('saved');

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
});
