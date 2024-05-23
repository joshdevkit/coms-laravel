<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsOwner
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->type === 0) {
            if (Auth::user()->is_activated === 1 && Auth::user()->is_deleted === 0) {
                return $next($request);
            } elseif (Auth::user()->is_deleted === 1) {
                Auth::logout(); // Logout the user if their account is deleted
                return redirect()->route('login')->with('error', 'Your account has been disabled. Please contact the administrator.');
            } else {
                // Account is not activated
                return redirect()->route('owner.update-once');
            }
        }

        // Redirect to the login page if user is not logged in or their account is deleted
        return redirect()->route('login')->with('error', 'Your account has been disabled. Please contact the administrator.');
    }
}
