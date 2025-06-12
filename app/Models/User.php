<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // app/Models/User.php

    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'numero',
        'ville',
        'rue',
        'code_postal'
    ];
    
    


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function rendezvousParent()
{
    return $this->hasMany(RendezVous::class, 'parent_id');
}

public function rendezvousSpecialiste()
{
    return $this->hasMany(RendezVous::class, 'specialiste_id');
}

public function paiements()
{
    return $this->hasMany(Paiement::class);
}

public function messagesEnvoyes()
{
    return $this->hasMany(Message::class, 'expediteur_id');
}

public function messagesRecus()
{
    return $this->hasMany(Message::class, 'destinataire_id');
}


public function isOnline()
{
    return Cache::has('user-is-online-' . $this->id);
}


}


