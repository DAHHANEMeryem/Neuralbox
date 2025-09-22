<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    
public function store(Request $request): RedirectResponse | JsonResponse
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
                    'redirect' => route('home') // Or the desired redirection route
                ]);
            }

            // Pour les requêtes normales, rediriger
            return redirect()->intended(route('home'));
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

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
