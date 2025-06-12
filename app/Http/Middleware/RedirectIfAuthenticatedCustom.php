<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticatedCustom
{
    public function handle(Request $request, Closure $next, string ...$guards)
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();
                

                // Rediriger l'admin vers /admin/dashboard
                if ($user->email === 'admin@gmail.com') {
                    return redirect('/admin/dashboard');
                }

                // Rediriger l'utilisateur normal vers /utilisateur/dashboard
                return redirect('/utilisateur/dashboard');
            }
        }

        return $next($request);
    }
}
