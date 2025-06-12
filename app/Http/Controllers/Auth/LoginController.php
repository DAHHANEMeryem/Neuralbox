<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Valider les données du formulaire
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Tenter la connexion
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Vérifier le rôle et rediriger
            if ($user->is_admin) {
                return redirect()->intended('/admin/dashboard');
            } else {
                return redirect()->intended('/utilisateur/dashboard');
            }
        }

        // Si l'authentification échoue
        return back()->withErrors([
            'email' => 'Les identifiants ne correspondent pas.',
        ])->onlyInput('email');
    }
}
