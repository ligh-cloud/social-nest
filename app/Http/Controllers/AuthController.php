<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            ' name'=>'required|max:100|string',
            'email'=>'required|string|email|unique:users',
            'password'=>'required|min:8|max:50'
        ]);

        $user = User::create([
            'name'=> $request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
        event(new Registered($user));

        $user->sendEmailVerificationNotification();
    }
}
