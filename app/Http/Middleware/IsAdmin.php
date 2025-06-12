<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Vérifie si l'utilisateur est connecté ET s'il est admin (par exemple, rôle ou colonne is_admin)
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // Sinon, redirige ou abort
        return redirect('/'); // Ou abort(403);
    }
}
