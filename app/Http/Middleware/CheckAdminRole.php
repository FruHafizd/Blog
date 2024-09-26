<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the authenticated user has the Admin role
        if (Auth::check() && Auth::user()->hasRole('Admin')) {
            return $next($request);
        }

        // Redirect to a different page or return a 403 response if not authorized
        return redirect('/')->with('error', 'You do not have access to this page.');
    }
}
