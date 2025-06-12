<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Affiche la page du compte utilisateur
     *
     *
     */
    public function index()
    {
        $user = Auth::user();
        return view('auth.account', compact('user'));
    }
}