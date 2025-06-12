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
        
    Schema::table('ressources', function (Blueprint $table) {
        $table->string('preview_image')->nullable();
        $table->integer('ordre')->default(0);
    });
   
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
     Schema::table('ressources', function (Blueprint $table) {
        $table->dropColumn('preview_image');
        $table->dropColumn('ordre');
    });
    }
};
