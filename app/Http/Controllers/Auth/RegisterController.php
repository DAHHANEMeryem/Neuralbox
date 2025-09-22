<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'numero' => 'string',
            'ville' => 'string',
            'rue' => 'string',
            'code_postal' => 'string',

        ]);
    
        // Création de l'utilisateur
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'numero' => $validated['numero'],
            'ville' => $validated['ville'],
            // 'rue'=>$validated['rue'],
            // 'code_postal'=>$validated['code_postal'],
        ]);

        Auth::login($user);

        // Enlève Auth::login($user) pour ne pas connecter automatiquement
        // Utilisateur redirigé vers la page de login

        // return redirect()->route('login')->with('success', 'Votre compte a été créé avec succès. Veuillez vous connecter.');

        return redirect()->back();
    }
}
