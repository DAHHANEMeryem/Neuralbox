<?php

namespace Database\Factories;

use App\Models\RendezVous;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RendezVousFactory extends Factory
{
    protected $model = RendezVous::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'date' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d H:i:s'),
            'message' => $this->faker->sentence(),
            'numero' => $this->faker->phoneNumber(),
            'email' => $this->faker->safeEmail(),
            'statut' => $this->faker->randomElement(['attente', 'confirme', 'annule']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
