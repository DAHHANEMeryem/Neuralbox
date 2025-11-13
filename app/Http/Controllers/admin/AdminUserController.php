<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\user;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
{
        $users = User::latest()->paginate(9);
   
    $totalUsers = User::count(); 
    return view('admin.utilisateurs', compact('users','totalUsers'));
}

public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('admin.utilisateurs')->with('success', 'Utilisateur supprimé avec succès.');
}



}
