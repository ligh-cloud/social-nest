<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\PostController;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if ($user->role_id === 1) {
             redirect()->route('admin.dashboard');
            return $next($request);
        }

        if ($user->role_id === 2) {
            return $next($request);
        }

        // Optional: if role_id is something else
        abort(403, 'Unauthorized access');
    }
}
