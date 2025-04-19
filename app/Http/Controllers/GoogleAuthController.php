<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Socialite\Contracts\Factory as Socialite;

class GoogleAuthController extends Controller
{
    protected $socialite;

    public function __construct(Socialite $socialite)
    {
        $this->socialite = $socialite;
    }

    /**
     * Redirect the user to Google's OAuth page.
     */
    public function redirect()
    {
        return $this->socialite->driver('google')->stateless()->redirect();
    }

    /**
     * Handle the callback from Google.
     */
    public function callback(Request $request)
    {
        // Validate the 'state' parameter to prevent CSRF attacks
        if ($request->input('state') !== session('state')) {
            return redirect('/')->with('error', 'Invalid state parameter.');
        }

        try {
            // Retrieve user information from Google
            $googleUser = $this->socialite->driver('google')->stateless()->user();
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Google authentication failed.');
        }

        // Ensure the user has an email address
        if (!$googleUser->getEmail()) {
            return redirect('/')->with('error', 'Google account does not have an email address.');
        }

        // Check if the user already exists in the database
        $existingUser = User::where('email', $googleUser->getEmail())->first();

        if ($existingUser) {
            // Log the user in if they already exist
            Auth::login($existingUser);
        } else {
            // Otherwise, create a new user and log them in
            $newUser = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => bcrypt(Str::random(16)),
                'email_verified_at' => now(),
                'google_id' => $googleUser->getId(),
                'role_id' => 2,
            ]);
            Auth::login($newUser);
        }

        // Redirect the user to the dashboard or any other secure page
        return redirect('/home');
    }
}
