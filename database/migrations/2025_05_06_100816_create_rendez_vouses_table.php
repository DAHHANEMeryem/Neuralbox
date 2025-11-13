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
        Schema::create('rendez_vouses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->nullable();
        
            $table->string('numero');
            $table->string('email');
            $table->dateTime('date');
            $table->text('message')->nullable(); // nouveau champ message
            $table->enum('statut', ['attente', 'confirme', 'annule'])->default('attente');
            $table->string('telephone')->nullable();
            $table->timestamp('scheduled_at')->nullable();
            $table->dateTime('date_heure')->nullable();
            $table->enum('arrive', ['oui', 'non'])->nullable();
            $table->decimal('montant_paye', 8, 2)->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rendez_vouses');
    }
};
