<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckOrganizer
{
    public function handle($request, Closure $next)
    {
        $user = User::find(session('id'));
        // dd($user->role);
        if ($user->role === 'organzer') {
            return $next($request);
        }

        abort(403, 'w9af 3and hadk.');
    }
}
