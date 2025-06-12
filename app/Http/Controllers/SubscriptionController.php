<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentInfoRequest;

use App\Models\Paiement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Exception\CardException;
use Stripe\Exception\InvalidRequestException;
use Stripe\Exception\AuthenticationException;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        // Initialiser Stripe avec la clé secrète
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Affiche la page des abonnements
     */
    public function index()
    {
        return view('subscriptions.index');
    }

    /**
     * Affiche le formulaire de paiement pour un plan spécifique
     */
    public function showPaymentForm($plan)
    {
        $plans = [
            'start' => [
                'name' => 'باقة الانطلاق',
                'price' => 0,
                'description' => 'Accès gratuit limité'
            ],
            'gold' => [
                'name' => 'الباقة الذهبية',
                'price' => 3200,
                'description' => 'Accès complet premium'
            ],
            'nouralbox' => [
                'name' => 'باقة نيورال بوكس',
                'price' => 2300,
                'description' => 'Accès standard complet'
            ]
        ];

        if (!array_key_exists($plan, $plans)) {
            abort(404);
        }

        // Si c'est le plan gratuit, pas besoin de paiement
        if ($plan === 'start') {
            return $this->processFreePlan();
        }

        $selectedPlan = $plans[$plan];
        $selectedPlan['slug'] = $plan;

        return view('payments.form', compact('selectedPlan'));
    }

    /**
     * Traite l'abonnement gratuit
     */
    private function processFreePlan()
    {
        if (Auth::check()) {
    $user = Auth::user();

    // Vérifier si l'utilisateur a déjà le pack gratuit
    if (!$user->has_free_pack) {
        // Mise à jour du champ dans la table users
        $user->update([
            'has_free_pack' => true
        ]);
    }

    return redirect()->route('subscription.success')
                     ->with('success', 'تم تفعيل باقة الانطلاق بنجاح!');
}

        return redirect()->route('login')
                        ->with('message', 'يرجى تسجيل الدخول أولاً');
    }

    /**
     * Traite le paiement de l'abonnement
     */
    public function processSubscriptionPayment(PaymentInfoRequest $request)
    {
        $validatedData = $request->validated();
        // Ajouter les informations utilisateur si connecté
        if (Auth::check()) {
            $validatedData['user_id'] = Auth::id();
            if (empty($validatedData['email'])) {
                $validatedData['email'] = Auth::user()->email;
            }
        }
        
        try {
            
            // Traitement selon la méthode de paiement
            switch ($validatedData['payment_method']) {
                case 'credit_card':
                    return $this->processStripePayment($validatedData);
                
                case 'paypal':
                    return $this->processPaypalPayment($validatedData);
                
                case 'bank_transfer':
                    return $this->processBankTransferPayment($validatedData);
                
                default:
                    return back()->withErrors(['payment' => 'طريقة دفع غير مدعومة.'])
                                 ->withInput();
            }

        } catch (\Exception $e) {
            Log::error('Payment processing error: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'amount' => $validatedData['amount'],
                'payment_method' => $validatedData['payment_method']
            ]);

            return back()->withErrors(['payment' => 'حدث خطأ أثناء معالجة الدفع. يرجى المحاولة مرة أخرى.'])
                         ->withInput($request->except(['stripeToken']));
        }
    }

    /**
     * Traitement du paiement Stripe
     */
    private function processStripePayment($data)
    {
        try {
            // Créer un client Stripe
            $customer = Customer::create([
               
                'source' => $data['stripeToken'],
                'name' => $data['card_holder_name'] ?? 'Customer',
                'phone' => $data['phone'] ?? null,
            ]);

            // Créer la charge
            $charge = Charge::create([
                'customer' => $customer->id,
                'amount' => $data['amount'] * 100, // Convertir en centimes
                'currency' => 'mad',
                'description' => $this->getPlanNameByAmount($data['amount']),
                'metadata' => [
                    'plan_type' => $data['plan_type'],
                    'user_id' => $data['user_id'] ?? 'guest',
                ],
            ]);
            

            if ($charge->status === 'succeeded') {
    // Données communes du paiement
$email = null;
if (!empty($data['email'])) {
    $email = $data['email'];
} elseif (Auth::check()) {
    $email = Auth::user()->email;
} else {
    $email = null;
}

Log::info('Email utilisé pour le paiement:', [
    'email' => $email,
    'data_email' => $data['email'] ?? null,
    'auth_email' => Auth::check() ? Auth::user()->email : 'non connecté',
]);

$paymentData = [
    'user_id' => $data['user_id'] ?? Auth::id(), // fallback sur l'utilisateur connecté
     'email' => $email,

    'name' => $this->getPlanNameByAmount($data['amount']),
    'amount' => $data['amount'],
    'method' => 'stripe',
    'status' => 'reussi',
    'stripe_charge_id' => $charge->id,
    'stripe_customer_id' => $customer->id ?? null,
];



    // Enregistrer le paiement
    $paymentInfo = Paiement::create($paymentData);

    // Redirection vers la page de confirmation
    return redirect()->route('subscription.confirmation', ['id' => $paymentInfo->id])
        ->with('success', 'تم الدفع بنجاح! مرحباً بك في نيورال بوكس');
} else {
    // Échec du paiement
    return back()->withErrors(['payment' => 'فشل في عملية الدفع. يرجى المحاولة مرة أخرى.'])
                 ->withInput();
}


        } catch (CardException $e) {
            // Erreur liée à la carte
            return back()->withErrors(['payment' => 'خطأ في البطاقة: ' . $e->getError()->message])
                         ->withInput();

        } catch (InvalidRequestException $e) {
            Log::error('Stripe Invalid Request: ' . $e->getMessage());
            return back()->withErrors(['payment' => 'طلب غير صحيح. يرجى التحقق من المعلومات.'])
                         ->withInput();

        } catch (AuthenticationException $e) {
            Log::error('Stripe Authentication Error: ' . $e->getMessage());
            return back()->withErrors(['payment' => 'خطأ في الاعتماد. يرجى المحاولة لاحقاً.'])
                         ->withInput();

        } catch (\Exception $e) {
            Log::error('Stripe General Error: ' . $e->getMessage());
            return back()->withErrors(['payment' => 'حدث خطأ غير متوقع. يرجى المحاولة مرة أخرى.'])
                         ->withInput();
        }
    }

    private function getUserEmail()
{
    return Auth::check() ? Auth::user()->email : null;
}

private function processPaypalPayment($data)
{
    $paymentData = array_merge($data, [
        'status' => 'pending',
        'payment_method' => 'paypal',
        // Tu peux ajouter ici un champ supplémentaire, comme un identifiant de transaction PayPal
        'paypal_transaction_id' => $data['paypal_transaction_id'] ?? null,
    ]);

    $paymentInfo = Paiement::create($paymentData);

    return redirect()->route('subscription.confirmation', ['id' => $paymentInfo->id])
                     ->with('info', 'سيتم توجيهك لإكمال الدفع عبر PayPal.');
}

/**
 * Traitement du virement bancaire
 */
private function processBankTransferPayment($data)
{
    $paymentData = array_merge($data, [
        'status' => 'pending',
        'payment_method' => 'bank_transfer',
        // Tu peux ajouter un champ pour une référence bancaire ou une pièce jointe
        'bank_reference' => $data['bank_reference'] ?? null,
        'transfer_receipt' => $data['transfer_receipt'] ?? null, // fichier PDF ou image
    ]);

    $paymentInfo = Paiement::create($paymentData);

    return redirect()->route('subscription.confirmation', ['id' => $paymentInfo->id])
                     ->with('info', 'تم استلام طلب التحويل البنكي. سيتم تفعيل الاشتراك بعد تأكيد الدفع.');
}


    /**
     * Affiche la page de confirmation d'abonnement
     */
public function showConfirmation($id)
{
    $paymentInfo = Paiement::findOrFail($id);

    if (Auth::check() && $paymentInfo->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
        abort(403);
    }

    // L'email à afficher = email enregistré dans la table Paiement
    $email = $paymentInfo->email ?? (Auth::check() ? Auth::user()->email : null);

    return view('payments.confirmation', compact('paymentInfo', 'email'));
}


    /**
     * Affiche la page de succès pour l'abonnement gratuit
     */
    public function showSuccess()
    {
        return view('payments.success');
    }

    /**
     * Obtient le nom du plan selon le montant
     */
    private function getPlanNameByAmount($amount)
    {
        switch ($amount) {
            case 3200:
                return 'الباقة الذهبية';
            case 2300:
                return 'باقة نيورال بوكس';
            default:
                return 'باقة مجهولة';
        }
    }
}