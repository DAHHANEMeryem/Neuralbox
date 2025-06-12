<?php






namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Vérifie si l'utilisateur existe déjà
        if (!User::where('email', 'test@example.com')->exists()) {
            User::create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => Hash::make('password'),
                    'ville' => 'tanger',
                    'rue' => 'rue al qods',
                    'code_postal' => '90000', // Ajoute cette ligne
              
                 // change si besoin
            ]);
        }

        // Appel du seeder pour admin
        $this->call(AdminUserSeeder::class);
         $this->call([
        RessourceSeeder::class,
    ]);
    
}
}
