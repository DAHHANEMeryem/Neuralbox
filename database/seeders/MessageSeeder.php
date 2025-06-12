<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MessageSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // إدخال بيانات وهمية
        for ($i = 0; $i < 50; $i++) {
            DB::table('messages')->insert([
                'nom' => $faker->firstName,
                'prenom' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'telephone' => $faker->phoneNumber,
                'message' => $faker->paragraph,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
