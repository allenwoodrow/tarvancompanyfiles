<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->is_admin) {
            // redirect non-admins back to user dashboard
            return redirect('/shop')->with('error', 'Access denied.');
        }

        return $next($request);
    }
}
