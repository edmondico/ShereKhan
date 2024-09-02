<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EnsureAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        Log::info('EnsureAuthenticated middleware: Checking authentication status.');

        if (!Auth::check() && !$request->is('/') && !$request->is('login') && !$request->is('register')) {
            Log::info('User is not authenticated, redirecting to home.');
            return redirect('/');
        }

        Log::info('User is authenticated, proceeding to next middleware.');
        return $next($request);
    }
}
