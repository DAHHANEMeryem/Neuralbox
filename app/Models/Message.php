<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'nom', 'prenom', 'email', 'telephone', 'message',
    ];

    public $timestamps = true;
    
}

