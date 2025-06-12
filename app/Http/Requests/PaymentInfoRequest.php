<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'card_holder_name' => 'required|string|max:255',
            'card_number' => 'required|string|size:16',
            'expiration_date' => 'required|string|size:5|regex:/^(0[1-9]|1[0-2])\/([0-9]{2})$/',
            'cvv' => 'required|string|size:3|numeric',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|in:credit_card,paypal,bank_transfer'
        ];
    }

    /**
     * Get custom error messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'card_number.size' => 'Le numéro de carte doit contenir 16 chiffres.',
            'expiration_date.regex' => 'La date d\'expiration doit être au format MM/YY.',
            'cvv.size' => 'Le code CVV doit contenir 3 chiffres.',
            'amount.min' => 'Le montant doit être supérieur à 0.',
        ];
    }
}