<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{


    protected $fillable = [
        'type',
        'status',
        'user_id',
        'paiement_id',
    ];




    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
public function paiement()
{
    return $this->belongsTo(Paiement::class, 'paiement_id');
}

}
