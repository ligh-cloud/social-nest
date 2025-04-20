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

        // Check for user including soft-deleted (banned) users
        $user = User::withTrashed()->where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Check if user is banned
            if ($user->trashed()) {
                return back()->with('error', 'Your account has been banned.');
            }

            Auth::login($user);

            // regenerate the session to prevent session fixation attacks
            $request->session()->regenerate();

            if($user->role_id === 1){
                return redirect('/admin');
            }
            return redirect()->route('home');
        }
        return back()->with('error', 'The provided credentials do not match our records');
    }
}
