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
        Schema::create('ressources', function (Blueprint $table) {
    $table->id();
    $table->string('titre');
    $table->text('description')->nullable();
    $table->string('video_url')->nullable();
    $table->enum('categorie', ['pedagogie', 'neuralbox']);
    $table->enum('visibilite', ['abonne', 'tous']); // accès
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
