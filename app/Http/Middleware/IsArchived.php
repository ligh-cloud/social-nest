<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsArchived
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {

            $user = User::withTrashed()->find(Auth::id());

            if ($user) {
                // Check if the account is archived, suspended or soft-deleted
                if ($user->trashed() || $user->archived || $user->suspended_until > now()) {
                    Auth::logout();
                    return redirect()->route('login')->with('message', 'Your account has been deactivated, suspended or deleted.');
                }
            }

            return $next($request);
        }

        return redirect()->route('login');
    }
}
