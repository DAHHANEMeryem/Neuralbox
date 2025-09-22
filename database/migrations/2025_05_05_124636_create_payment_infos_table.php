<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('payment_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            // $table->string('card_holder_name');
            // $table->string('card_number');
            // $table->string('expiration_date');
            // $table->string('cvv');
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            // $table->string('postal_code');
            $table->string('country')->nullable();
            $table->string('phone');
            $table->string('email')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('status')->default('pending');
            $table->string('payment_method')->default('card');
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_infos');
    }

};
