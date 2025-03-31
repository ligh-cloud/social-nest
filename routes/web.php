<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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
