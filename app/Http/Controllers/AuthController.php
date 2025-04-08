<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|max:100|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:8|max:50'
        ]);





        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));


        return redirect()->route('verification.notice')->with('success', 'Verification email sent.');

    }
    public function login(Request $request)
    {

        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {

            Auth::login($user);

            // regenerate the session to prevent session fixation attacks
            $request->session()->regenerate();


            return redirect()->intended('home');
        }
        return back()->with('error' , 'The provided credentials do not match our records');
    }
}
