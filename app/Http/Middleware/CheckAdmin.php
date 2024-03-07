<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle($request, Closure $next)
    {

        $user = User::find(session('id'));
        // dd($user->role);
        if ($user->role === 'admin') {
            return $next($request);
        }

        abort(403, 'hhhhhh shofoni Had xi dyal mol xi.');
    }
}
