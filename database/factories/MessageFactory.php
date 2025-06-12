<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Message;
use App\Models\User;

class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   public function definition(): array
{
    return [
        'nom' => $this->faker->lastName(),
        'prenom' => $this->faker->firstName(),
        'email' => $this->faker->unique()->safeEmail(),
        'telephone' => $this->faker->phoneNumber(),  // <-- Ajoute ça !
        'message' => $this->faker->sentence(),
        'is_read' => $this->faker->boolean(30),
        'created_at' => now()->subDays(rand(0, 15)),
        'updated_at' => now(),
    ];
}

}
