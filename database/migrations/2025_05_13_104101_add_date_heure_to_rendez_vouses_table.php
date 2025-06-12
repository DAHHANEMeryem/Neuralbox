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
        Schema::table('rendez_vouses', function (Blueprint $table) {
            $table->dateTime('date_heure')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('rendez_vouses', function (Blueprint $table) {
            $table->dropColumn('date_heure');
        });
    }
};
