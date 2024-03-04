<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAuth
{
    public function handle($request, Closure $next)
    {
        if (!session('id')) {
            // User is not authenticated, handle accordingly (e.g., redirect to login page)
            return redirect()->route('getSignInView');
        }

        return $next($request);
    }
}
