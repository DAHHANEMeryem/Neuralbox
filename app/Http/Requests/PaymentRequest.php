<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
            'payment_option' => 'required|in:card,transfer',
            'pack' => 'required|string|in:golden,neuralbox',
            
        ];

        // Règles spécifiques pour les cartes de crédit avec Stripe
        if ($this->payment_option === 'card') {
            $firstDayOfCurrentMonth = Carbon::now()->startOfMonth()->toDateString();

            $rules = array_merge($rules, [
                'card_number' => 'required|regex:/^(?:\\d[ -]*?){13,16}$/',
                'card_expiry' => ['required','date','after_or_equal:'. $firstDayOfCurrentMonth,],               
                'card_cvv' => 'required|regex:/^\d{3,4}$/',
            ]);
        }else{
            $rules = array_merge($rules, [
                'receipt' => 'required|mimes:jpeg,png,jpg,webp',
            ]);

        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'payment_option.required' => __('payment.errors.payment_option_required'),
            'payment_option.in' => __('payment.errors.payment_option_in'),
            'card_holder_name.required' => 'يرجى إدخال اسم حامل البطاقة.',
            'receipt.extensions' => 'يجب أن يحتوي حقل الإيصال على أحد الامتدادات التالية: jpg، png، pdf.',
            'email.required' => 'يرجى إدخال البريد الإلكتروني.',
            'email.email' => 'البريد الإلكتروني غير صحيح.',
            'phone.string' => 'رقم الهاتف يجب أن يكون نصاً.',
            'address.string' => 'العنوان يجب أن يكون نصاً.',
            'city.string' => 'المدينة يجب أن تكون نصاً.',
            'postal_code.string' => 'الرمز البريدي يجب أن يكون نصاً.',
            'country.size' => 'رمز البلد يجب أن يكون حرفين.',
            'amount.required' => 'المبلغ مطلوب.',
            'amount.numeric' => 'المبلغ يجب أن يكون رقماً.',
            'amount.min' => 'المبلغ يجب أن يكون أكبر من أو يساوي 0.',
            'plan_type.required' => 'نوع الباقة مطلوب.',
            'plan_type.in' => 'نوع الباقة المختار غير صحيح.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Nettoyer l'email
        if ($this->has('email')) {
            $this->merge([
                'email' => trim(strtolower($this->email)),
            ]);
        }

        // Nettoyer le nom du porteur de carte
        if ($this->has('card_holder_name')) {
            $this->merge([
                'card_holder_name' => trim($this->card_holder_name),
            ]);
        }
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Validation supplémentaire pour s'assurer que le montant correspond au plan
            $planPrices = [
                'gold' => 3200,
                'nouralbox' => 2300,
            ];

            if ($this->has('plan_type') && $this->has('amount')) {
                $expectedAmount = $planPrices[$this->plan_type] ?? null;
                if ($expectedAmount && $this->amount != $expectedAmount) {
                    $validator->errors()->add('amount', 'المبلغ لا يتطابق مع الباقة المختارة.');
                }
            }
        });
    }
}