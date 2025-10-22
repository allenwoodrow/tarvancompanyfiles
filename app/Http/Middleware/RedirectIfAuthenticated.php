<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // ✅ Admins go to admin dashboard
                if (Auth::user()->is_admin) {
                    return redirect()->route('admin.dashboard');
                }

                // ✅ Normal users go to shop instead of dashboard
                return redirect()->route('shop');
            }
        }

        return $next($request);
    }
}
