<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleAuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Email Verification Routes

// Route to display the email verification notice
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home')->with('success', 'Email verified successfully.');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Route to resend the email verification link
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Authentication Routes

// Route to display the login page
Route::get('/', function () {
    return view('welcome');
})->name('login');

Route::post('/login' , [AuthController::class , 'login'])->name('auth');

// Route to handle user registration
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Routes that require authentication and email verification
Route::middleware(['auth', 'verified'])->group(function () {

    // Route to the home page
    Route::get('/home', function () {
        return view('user.home');
    })->name('home');

    // Additional authenticated routes
    Route::get('/watch', function () {
        return 'This is the watch page.';
    })->name('watch');

    Route::get('/memories', function () {
        return 'This is the memories page.';
    })->name('memories');

    Route::get('/pages', function () {
        return 'This is the pages page.';
    })->name('pages');

    Route::get('/events', function () {
        return 'This is the events page.';
    })->name('events');

    Route::get('/settings', function () {
        return 'This is the settings page.';
    })->name('settings');

    // Route to handle user logout
    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/')->with('message', 'Logged out successfully.');
    })->name('logout');

    // Route to view friend requests
    Route::get('friends/requests', function () {
        return view('user.friend_request');
    })->name('friends.requests');

    // Route to the admin home page
    Route::get('admin/home', function () {
        return view('admin.admin');
    })->name('admin.home');

    // Route to user settings
    Route::get('user/settings', function () {
        return view('user.settings');
    })->name('user.settings');

    // Route to view friends list
    Route::get('/friends', function () {
        return view('user.friends');
    })->name('friends');

    // Route to view notifications
    Route::get('/notifications', function () {
        return view('user.notification');
    })->name('notifications');

    // Route to view saved posts
    Route::get('/posts/saved', function () {
        return view('user.saved');
    })->name('posts.saved');

    // Route to view watched posts
    Route::get('/posts/watch', function () {
        return view('user.watch');
    })->name('posts.watch');
});

// Route to handle password reset requests
Route::get('password', function () {
    return 'Password reset page.';
})->name('password.request');

// Google OAuth Routes

// Route to redirect to Google's OAuth page
Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('auth.google.redirect');

// Route to handle the callback from Google
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('auth.google.callback');


use App\Http\Controllers\Auth\FacebookController;

Route::get('login/facebook', [FacebookController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);
Route::get('/saved' , function (){
    return "this is the saved page";
})->name("saved");
