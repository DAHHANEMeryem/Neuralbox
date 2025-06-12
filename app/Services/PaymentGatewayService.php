<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class PaymentGatewayService
{
    public function payWithAmanPay(array $paymentData)
    {
        // Exemple : URL fictive, à adapter selon l’API AmanPay
        $url = 'https://api.amanpay.ma/payment/initiate';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.amanpay.secret'),
            'Accept' => 'application/json',
        ])->post($url, [
            'amount' => $paymentData['amount'],
            'currency' => 'MAD',
            'payment_method' => $paymentData['payment_method'],
            'card_number' => $paymentData['card_number'] ?? null,
            'cvv' => $paymentData['cvv'] ?? null,
            'expiry_date' => $paymentData['expiry_date'] ?? null,
            'user_email' => $paymentData['email'],
            'callback_url' => route('subscription.confirmation.callback'), // URL de retour
        ]);

        return $response->json();
    }
}
