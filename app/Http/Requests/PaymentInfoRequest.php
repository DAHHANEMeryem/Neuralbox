<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentInfoRequest extends FormRequest
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
            'payment_method' => 'required|in:credit_card,paypal,bank_transfer',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|size:2',
            'amount' => 'required|numeric|min:0',
            'plan_type' => 'required|string|in:gold,nouralbox',
        ];

        // Règles spécifiques pour les cartes de crédit avec Stripe
        if ($this->payment_method === 'credit_card') {
            $rules = array_merge($rules, [
                'card_holder_name' => 'required|string|max:255',
                'stripeToken' => 'required|string', // Token généré par Stripe Elements
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
            'payment_method.required' => 'يرجى اختيار طريقة الدفع.',
            'payment_method.in' => 'طريقة الدفع المختارة غير صحيحة.',
            'card_holder_name.required' => 'يرجى إدخال اسم حامل البطاقة.',
            'stripeToken.required' => 'خطأ في معلومات البطاقة، يرجى المحاولة مرة أخرى.',
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