<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('subscriptions', function (Blueprint $table) {
        $table->unsignedBigInteger('paiement_id')->nullable()->after('user_id');
        $table->foreign('paiement_id')->references('id')->on('paiements')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('subscriptions', function (Blueprint $table) {
        $table->dropForeign(['paiement_id']);
        $table->dropColumn('paiement_id');
    });
}

};
