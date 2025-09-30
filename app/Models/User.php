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


    public function subscription()
    {
        return $this->hasOne(Subscription::class, 'user_id');
    }

    /**
     * Determine if the user has a gold subscription.
     *
     * @return bool
     */
    public function hasGoldSubscriptionOrIsAdmin(): bool
    {
        if ($this->is_admin) {
            return true;
        }
        return $this->subscription() && $this->subscription()->where('type', 'golden')->exists();
    }



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
// Dans app/Models/User.php

public function getRedirectRoute()
{
    return $this->is_admin ? route('admin.dashboard') : route('home');
}
public function sentMessages()
{
    return $this->hasMany(Contact::class, 'sender_id');
}

public function receivedMessages()
{
    return $this->hasMany(Contact::class, 'receiver_id');
}
public function messagesSent()
{
    return $this->hasMany(Message::class, 'sender_id');
}

public function messagesReceived()
{
    return $this->hasMany(Message::class, 'receiver_id');
}
public function lastMessage()
{
    return $this->hasOne(Contact::class, 'sender_id')->latestOfMany();
}
public function contacts()
{
    return $this->hasMany(Contact::class, 'sender_id');
}
public function scopeSearch($query, $term)
{
    return $query->where('name', 'like', "%$term%")
                 ->orWhere('email', 'like', "%$term%");
}
public function messages()
{
    return $this->hasMany(Contact::class, 'sender_id');
}

public function latestMessage()
{
    return $this->hasOne(Contact::class, 'sender_id')->latestOfMany();
}
public function sentContacts()
{
    return $this->hasMany(Contact::class, 'sender_id');
}

public function receivedContacts()
{
    return $this->hasMany(Contact::class, 'receiver_id');
}


    protected $appends = ['subscription_type'];

    public function getSubscriptionTypeAttribute()
    {
        $subscription = $this->subscription()->where('status', 'confirmed')->first();
        return $subscription ? $subscription->type : null;
    }





    // User.php



}


