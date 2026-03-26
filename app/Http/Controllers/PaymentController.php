<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function showPaymentForm(Request $request)
    {
        $pack = $request->input('pack', 'golden');
        $montants = ['golden' => 3200, 'silver' => 2300];

        if (!isset($montants[$pack])) {
            abort(404, "Pack invalide");
        }

        $amount = $montants[$pack];
        return view('payments.info', compact('amount', 'pack'));
    }

    public function processPayment(Request $request)
    {
        $rules = [
            'pack'           => 'required|in:golden,silver',
            'payment_option' => 'required|string',
            'full_name'      => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'phone'          => 'required|string|max:20',
            'city'           => 'required|string|max:50',
            'address'        => 'required|string|max:255',
        ];

        if (!Auth::check()) {
            $rules['email'] = 'required|email|max:255|unique:users,email';
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        $request->validate($rules);

        try {
            return DB::transaction(function () use ($request) {
                $user = Auth::user();

                if (!$user) {
                    $user = User::create([
                        'name'     => $request->full_name,
                        'email'    => $request->email,
                        'password' => Hash::make($request->password),
                        'numero'   => $request->phone,
                        'ville'    => $request->city,
                        'rue'      => $request->address,
                    ]);
                    Auth::login($user);
                }

                $montants = ['golden' => 3200, 'silver' => 2300];
                $pack = $request->input('pack');
                $montant = $montants[$pack];

                $paiement = Paiement::create([
                    'user_id' => $user->id,
                    'pack'    => $pack,
                    'amount'  => $montant,
                    'method'  => $request->input('payment_option'),
                    'name'    => $request->input('full_name'),
                    'email'   => $request->input('email'),
                    'phone'   => $request->input('phone'),
                    'city'    => $request->input('city'),
                    'address' => $request->input('address'),
                    'receipt' => null,
                ]);

                return redirect()->route('payment.confirmation', ['id' => $paiement->id])
                                 ->with('success', 'Votre commande est enregistrée !');
            });
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Erreur : ' . $e->getMessage()])->withInput();
        }
    }

    public function showConfirmation($id)
    {
        $paymentInfo = Paiement::findOrFail($id);
        if (Auth::id() !== $paymentInfo->user_id) { abort(403); }
        return view('payments.confirmation', compact('paymentInfo'));
    }
}