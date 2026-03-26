<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            
        ]);
    
        // Création de l'utilisateur
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
          
        ]);

        event(new Registered($user));

        Auth::login($user);


        // Check if the request is an AJAX request
        if ($request->ajax() || $request->wantsJson()) {
            // Return a JSON response for AJAX requests
            return response()->json([
                'success' => true,
                'message' => 'Votre compte a été créé avec succès.',
                'redirect' => back()->getTargetUrl() ,
            ]);
        }

        // Otherwise, return a normal redirect response
        return redirect('/')->with('success', 'Votre compte a été créé avec succès.');
    }
}