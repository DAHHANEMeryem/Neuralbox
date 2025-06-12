<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
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
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'numero' => 'required|string',
            'ville'=>'required|string',
            'rue'=>'required|string',
            'code_postal'=>'required|string',
        ]);
    
        // Création de l'utilisateur
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'numero' => $validated['numero'],
            'ville' =>$validated['ville'],
            'rue'=>$validated['rue'],
            'code_postal'=>$validated['code_postal'],
        ]);

        event(new Registered($user));

        // Retirer la ligne Auth::login($user); pour ne pas connecter automatiquement

        return redirect(route('login', absolute: false))
               ->with('success', 'Votre compte a été créé avec succès. Veuillez vous connecter.');
    }
}