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
        // Schema::create('payment_infos', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
        //     $table->string('card_holder_name');
        //     // $table->string('card_number')->nullable(); // Nullable pour les autres méthodes de paiement
        //     // $table->string('expiration_date')->nullable();
        //     // $table->string('cvv')->nullable();
        //     // $table->string('address');
        //     // $table->string('city');
        //     // $table->string('postal_code');
        //     // $table->string('country', 2);
        //     $table->string('phone');
        //     $table->string('email');
        //     $table->decimal('amount', 10, 2);
        //     $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');
        //     $table->enum('payment_method', ['credit_card', 'paypal', 'bank_transfer'])->default('credit_card');
        //     $table->timestamps();
            
        //     // Index pour les recherches fréquentes
        //     $table->index(['user_id', 'status']);
        //     $table->index('email');
        //     $table->index('created_at');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('payment_infos');
    }
};