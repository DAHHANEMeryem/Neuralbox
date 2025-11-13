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
        Schema::create('rates', function (Blueprint $table) {
            $table->id();

            // Relations
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('ressource_id')->constrained()->onDelete('cascade');

            // Evaluation fields (enum for fixed choices)
            $table->enum('manual_steps_respect', ['fully', 'partially', 'not_at_all'])->nullable(); 
            $table->enum('family_involvement', ['good', 'average', 'weak'])->nullable(); 
            $table->enum('enjoyment', ['good', 'average', 'weak'])->nullable(); 
            $table->enum('challenge_and_persistence', ['good', 'average', 'weak'])->nullable(); 
            $table->enum('focus_and_memory', ['good', 'average', 'weak'])->nullable(); 
            $table->enum('motor_and_emotional_stability', ['good', 'average', 'weak'])->nullable(); 
            $table->enum('digital_addiction_avoidance', ['fully', 'partially', 'not_at_all'])->nullable();
            $table->enum('attached_docs_usage', ['fully', 'partially', 'not_at_all'])->nullable(); 

            // Open text fields
            $table->text('game_strengths')->nullable(); 
            $table->text('observed_results')->nullable(); 
            $table->text('difficulties')->nullable(); 
            $table->text('general_notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rates');
    }
};
