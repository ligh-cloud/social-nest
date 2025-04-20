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

        // First check if user exists with this Google ID (including soft-deleted users)
        $existingUser = User::withTrashed()->where('google_id', $googleUser->getId())->first();

        if ($existingUser) {
            // If user exists with this Google ID, check if they are soft-deleted
            if ($existingUser->trashed()) {
                // Restore the soft-deleted user
                $existingUser->restore();
            }
            Auth::login($existingUser);
        } else {
            // If no user with this Google ID, check by email (including soft-deleted users)
            $existingUser = User::withTrashed()->where('email', $googleUser->getEmail())->first();

            if ($existingUser) {
                // If user exists with this email, update their Google ID and restore if soft-deleted
                if ($existingUser->trashed()) {
                    $existingUser->restore();
                }
                $existingUser->update(['google_id' => $googleUser->getId()]);
                Auth::login($existingUser);
            } else {
                // Create a new user
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
        }

        // Redirect based on user role
        if (Auth::user()->role_id === 1) {
            return redirect('/admin');
        }
        return redirect('/home');
    }
}
