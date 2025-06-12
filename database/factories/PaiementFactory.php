<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paiement>
 */
class PaiementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
 public function definition(): array
{
    // Pour avoir plusieurs montants dont 2300 et 3200
    $montantsPossibles = [2300, 3200, ];

    return [
        'user_id' => User::factory(),
        'name' => fake()->name(),
        'amount' => $this->faker->randomElement($montantsPossibles),
        'method' => fake()->randomElement(['carte', 'paypal', 'virement']),
        'status' => fake()->randomElement(['failed', 'success', 'pending']),
        'created_at' => now()->subDays(rand(0, 30)),
        'updated_at' => now(),
    ];
}

}
