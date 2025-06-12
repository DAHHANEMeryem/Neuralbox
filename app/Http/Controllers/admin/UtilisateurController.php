<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UtilisateurController extends Controller
{
    public function index()
    {
        $utilisateurs = User::latest()->paginate(10);
        return view('admin.utilisateurs.index', compact('utilisateurs'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.utilisateurs.show', compact('user'));
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->back()->with('success', 'Utilisateur supprimé.');
    }
}
