<?php

use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


//verify the email

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


//the Auth routes:

Route::get('/', function () {
    return view('welcome');
});
Route::post('/register' , [AuthController::class , 'register'])->name('register');

Route::get('/home', function () {
    return view('user.home');
})->name('home');

//Route::get('/friends' , function(){
//    return 'this is friends page';
//})->name('friends');

Route::get('/watch' , function(){
    return 'this is watch page ';
})->name('watch');

Route::get('/memories' , function(){
    return 'this is memorie page';
})->name('memories');

//Route::get('/saved' , function(){
//    return 'this is saved page';
//})->name('saved');
Route::get('/pages' , function(){
    return 'this is pages page';
})->name('pages');

Route::get('/events' , function(){
    return 'this is events page';
})->name('events');

Route::get('/settings' , function(){
    return 'this is settings page';
})->name('settings');

Route::get('/logout' , function(){
    return 'this is logout page';
})->name('logout');

Route::get('friends/requests' , function (){
    return view('user.friend_request');
});

Route::get('admin/home' , function (){
    return view('admin.admin');
});

Route::get('user/settings' , function (){
    return view('user.settings');
});

Route::get('/friends' , function(){
    return view('user.friends');
})->name('friends');

Route::get('/notifications', function (){
    return view('user.notification');
});

    Route::get('/posts/saved' , function (){
    return view('user.saved');
})->name('saved');
Route::get('/posts/watch' , function (){
    return view('user.watch');
})->name('watch');



Route::group(['middleware' => 'AuthAndVerified'] , function(){
    //this is the middleware that checks the verification of email

});


Route::get('/test-email', function () {
    try {
        Mail::raw('This is a test email.', function ($message) {
            $message->to('belghitihatim00@gmail.com')
                ->subject('Test Email');
        });

        return 'Test email sent.';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});
