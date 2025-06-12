<?php

// app/Models/Contact.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
   // app/Models/Contact.php

    protected $fillable = ['sender_id', 'receiver_id', 'message', 'read_at','attachement'];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

public function attachments()
{
    return $this->hasMany(Attachment::class);
}


}
