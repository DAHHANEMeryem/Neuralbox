<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LastUserActivity
{
    public function handle($request, Closure $next)
{
    if (auth()->check()) {
        User::where('id', auth()->id())->update(['last_seen' => now()]);
    }

    return $next($request);
}
}