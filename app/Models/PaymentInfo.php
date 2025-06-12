<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'card_holder_name',
        'card_number',
        'expiration_date',
        'cvv',
        'address',
        'city',
        'postal_code',
        'country',
        'phone',
        'email',
        'amount',
        'status',
        'payment_method'
    ];

    /**
     * Masque les 12 premiers chiffres du numéro de carte
     */
    public function getMaskedCardNumberAttribute()
    {
        return '****-****-****-' . substr($this->card_number, -4);
    }

    /**
     * Relation avec l'utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}