<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::table('paiements', function (Blueprint $table) {
        //     // Modifier la colonne status pour avoir une taille plus grande
        //     $table->string('status', 20)->change();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('paiements', function (Blueprint $table) {
        //     // Remettre la taille d'origine (exemple 6)
        //     $table->string('status', 6)->change();
        // });
    }
};
