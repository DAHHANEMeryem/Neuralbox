<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Affiche le formulaire d'information de paiement
     */
    
    public function showPaymentForm(Request $request)
{
    $pack = $request->input('pack', 'golden'); // par défaut golden
    $montants = [
        'golden' => 3200,
        'silver' => 2300,
    ];

    if (!isset($montants[$pack])) {
        abort(404, "Pack invalide");
    }

    $amount = $montants[$pack];

    return view('payments.info', compact('amount', 'pack'));
}


    /**
     * Traite les informations de paiement soumises
     */


public function processPayment(Request $request)
{
    $user = auth()->user();

    // Valider le formulaire
    $request->validate([
        'pack'           => 'required|in:golden,silver',
        'payment_option' => 'required|string',
        'full_name'      => 'required|string|max:255',
        'email'          => 'nullable|email|max:255',
        'phone'          => 'nullable|string|max:20',
        'city'           => 'nullable|string|max:50',
        'address'        => 'nullable|string|max:255',
        'receipt'        => 'nullable|string|max:255',
    ]);

    // Définir les montants selon le pack choisi
    $montants = [
        'golden' => 3200,
        'silver' => 2300,
    ];
    $pack    = $request->input('pack');
    $montant = $montants[$pack];

    // Créer le paiement
    $paiement = Paiement::create([
        'user_id' => $user->id ?? null,
        'pack'    => $pack,
        'amount'  => $montant,
        'method'  => $request->input('payment_option'),
        'name'    => $request->input('full_name'),
        'email'   => $request->input('email'),
        'phone'   => $request->input('phone'),
        'city'    => $request->input('city'),
        'address' => $request->input('address'),
        'receipt' => $request->input('receipt') ?? null,
    ]);

    return redirect()->route('payment.confirmation', ['id' => $paiement->id])
                     ->with('success', 'Paiement enregistré avec succès !');
}



 




    /**
     * Affiche la page de confirmation de paiement
     */
    public function showConfirmation($id)
    {
        $paymentInfo = Paiement::findOrFail($id);

        if (Auth::check() && $paymentInfo->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }
        
        return view('payments.confirmation', compact('paymentInfo'));
    }
}
