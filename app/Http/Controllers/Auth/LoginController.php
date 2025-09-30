<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        try {
            // Valider les données du formulaire
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            // Tenter la connexion
            if (!Auth::attempt($credentials)) {
                throw ValidationException::withMessages([
                    'email' => __('auth.failed'),
                ]);
            }

            // Si l'authentification réussit
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Connexion réussie!',
                    'redirect' => back()->getTargetUrl() // Or the desired redirection route
                ]);
            }

            // Pour les requêtes normales, rediriger
            return redirect()->back();
        } catch (ValidationException $e) {
            // Gérer les erreurs de validation
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'errors' => $e->errors(),
                ], 422);
            }

            // Pour les requêtes normales, rediriger avec les erreurs
            return back()->withErrors($e->errors())->onlyInput('email');
        }
    }
}
