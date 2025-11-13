<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{

    protected $fillable = [
        'user_id',
        'ressource_id',
        'manual_steps_respect',
        'focus_and_memory',
        'family_involvement',
        'motor_and_emotional_stability',
        'enjoyment',
        'challenge_and_persistence',
        'digital_addiction_avoidance',
        'attached_docs_usage',
        'game_strengths',
        'observed_results',
        'difficulties',
        'general_notes',
    ];

    public function ressource()
    {
        return $this->belongsTo(Ressource::class,);
    }
    public function user()
    {
        return $this->belongsTo(User::class,);
    }
}
