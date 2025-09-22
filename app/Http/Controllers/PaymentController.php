<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentInfoRequest;
use App\Http\Requests\PaymentRequest;
use App\Models\PaymentInfo;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Affiche le formulaire d'information de paiement
     *
     * @return \Illuminate\View\View
     */
    public function showPaymentForm()
    {
        return view('payments.info');
    }

    /**
     * Traite les informations de paiement soumises
     *
     * @param PaymentInfoRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processPayment(Request $request)
    {
        // Récupération des données validées
        $validatedData = $request->all();
        
        // Ajout de l'ID utilisateur si connecté
        if (Auth::check()) {
            $validatedData['user_id'] = Auth::id();
        }

        try {
            // Simulation d'un appel à une API de paiement
            // Dans un environnement de production, vous appelleriez ici votre passerelle de paiement
            $paymentProcessed = $this->simulatePaymentGateway($validatedData);
            dd("hna");
            if ($paymentProcessed) {
                // Enregistrement des informations de paiement en base de données
                $validatedData['status'] = 'completed';
                $subscription = Subscription::create(['type'=> $validatedData['pack']]);
                $subscription->user()->attach($validatedData['user_id']);

                // $paymentInfo = PaymentInfo::create($validatedData);

                return view('payments.confirmation');
                // return redirect()->route('payment.confirmation')
                //                 ->with('success', 'Paiement traité avec succès');
            } else {
                return back()->withErrors(['payment' => 'Le paiement a échoué, veuillez réessayer.'])
                            ->withInput($request->except(['card_number', 'cvv']));
            }
        } catch (\Exception $e) {
            return back()->withErrors(['payment' => 'Une erreur est survenue lors du traitement du paiement.'])
                        ->withInput($request->except(['card_number', 'cvv']));
        }
    }

    /**
     * Affiche la page de confirmation de paiement
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function showConfirmation($id)
    {
        $paymentInfo = PaymentInfo::findOrFail($id);
        
        // Vérification que l'utilisateur a le droit de voir cette confirmation
        if (Auth::check() && $paymentInfo->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }
        
        return view('payments.confirmation', compact('paymentInfo'));
    }

    /**
     * Simulation d'une passerelle de paiement
     * Dans un environnement réel, cette méthode appellerait une API de paiement
     *
     * @param array $data
     * @return bool
     */
    private function simulatePaymentGateway($data)
    {
        // Pour un cas réel, nous utiliserions une passerelle de paiement comme Stripe
        // Exemple d'utilisation avec Stripe serait :
        /*
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        
        try {
            $charge = \Stripe\Charge::create([
                'amount' => $data['amount'] * 100, // Montant en centimes
                'currency' => 'eur',
                'source' => $data['stripe_token'], // Obtenu via Stripe.js dans le front-end
                'description' => 'Paiement depuis le site',
                'metadata' => [
                    'customer_name' => $data['card_holder_name'],
                    'email' => $data['email']
                ]
            ]);
            
            return $charge->status === 'succeeded';
        } catch (\Exception $e) {
            \Log::error('Erreur de paiement Stripe: ' . $e->getMessage());
            return false;
        }
        */
        
        // Pour la simulation
        if ($data['payment_method'] === 'card') {
            // Validation supplémentaire du numéro de carte
            $cardNumber = preg_replace('/\D/', '', $data['card_number']);
            
            // Algorithme de Luhn pour valider le numéro de carte
            $sum = 0;
            $alt = false;
            
            for ($i = strlen($cardNumber) - 1; $i >= 0; $i--) {
                $n = intval($cardNumber[$i]);
                
                if ($alt) {
                    $n *= 2;
                    if ($n > 9) {
                        $n = ($n % 10) + 1;
                    }
                }
                
                $sum += $n;
                $alt = !$alt;
            }
            
            $valid = ($sum % 10 == 0);
            
            // Simulation avec 95% de réussite pour les cartes valides
            return $valid && (rand(1, 100) <= 95);
        }
        
        // PayPal et virement bancaire sont toujours acceptés dans notre simulation
        return true;
    }
}