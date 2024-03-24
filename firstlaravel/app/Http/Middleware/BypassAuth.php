<?php

namespace App\Http\Middleware;

use Closure;

class BypassAuth
{
    public function handle($request, Closure $next)
    {
        // Check if you want to bypass authentication based on a condition
        if ($request->has('bypass_auth')) {
            // Bypass authentication
            return $next($request);
        }

        // Continue with normal authentication
        return $next($request);
    }
}