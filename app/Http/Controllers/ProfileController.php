<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // عرض بيانات المستخدم
    public function index()
    {
        $user = Auth::user(); // جلب بيانات المستخدم المسجل
        return view('profile.index', compact('user'));
    }

    // عرض نموذج تعديل البيانات
    public function update(Request $request)
{
    $user = Auth::user();

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'numero' => 'required|string|max:20',
        'rue' => 'required|string',
        'ville' => 'required|string',
        'code_postal' => 'required|string',
    ]);

    $user->update([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'numero' => $validated['numero'],
        'rue' => $validated['rue'],
        'ville' => $validated['ville'],
        'code_postal' => $validated['code_postal'],
    ]);

    return redirect()->route('profile')->with('success', 'Profil mis à jour avec succès');
}
public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required|string',
        'new_password' => 'required|string|min:8|confirmed',
    ]);

    // Vérifie si le mot de passe actuel est correct
    if (!Hash::check($request->current_password, Auth::user()->password)) {
        return redirect()->back()->with('error', 'Le mot de passe actuel est incorrect.');
    }

    // Met à jour le mot de passe
    $user = Auth::user();
    $user->password = Hash::make($request->new_password);
    $user->save();

    // Déconnecte l'utilisateur après avoir mis à jour son mot de passe
    Auth::logout();

    // Redirige vers la page de connexion
    return redirect()->route('login')->with('success', 'Mot de passe mis à jour avec succès. Veuillez vous reconnecter.');
}

}