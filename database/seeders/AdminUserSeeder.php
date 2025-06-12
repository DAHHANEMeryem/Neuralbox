<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
  

public function run(): void
{
    if (!User::where('email', 'admin@gmail.com')->exists()) {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('1234567890'), 
            'email_verified_at' => now(),
                'ville' => 'tanger',
                    'rue' => 'rue al qods',
                    'code_postal' => '90000', 
                'is_admin'=>true,    // Ajoute cette ligne
            
            
        ]);
    }
}

}
