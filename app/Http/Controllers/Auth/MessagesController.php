<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function showRegistrationForm()
    {
        return view('welcome');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            // 'email' => 'required|string|email|max:255|unique:messages',
             'email' => 'required|string|email|max:255', 
            'telephone' => 'required|string|min:8',
            'message' => 'required|string',
        ]);

        Message::create($validated);

        return redirect()->route('welcome')->with('success', 'تم إرسال رسالتك بنجاح.');
    }
}
