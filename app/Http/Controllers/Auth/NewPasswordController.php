<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\User;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request, string $token): View
{
    return view('auth.passwords.reset', [
        'token' => $token,
        'email' => $request->email
    ]);
}


    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
         $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

       $status = Password::reset(
    $request->only('email', 'password', 'password_confirmation', 'token'),
    function ($user, $password) {
        $user->forceFill([
            'password' => Hash::make($password),
            'remember_token' => Str::random(60),
        ])->save();

        event(new PasswordReset($user));
    }
);

dd($status); // ← AJOUTE CETTE LIGNE

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }


    public function update(Request $request)
    {
        // 1. Validation
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        // 2. Trouver l'utilisateur
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('message', 'المستخدم غير موجود');
        }

        // 3. Mettre à jour le mot de passe
        $user->password = Hash::make($request->password);
        $user->save();

        // 4. Redirection avec succès
        return redirect()->route('login')->with('message', 'تم تغيير كلمة المرور بنجاح. يمكنك تسجيل الدخول الآن.');
    }
}


