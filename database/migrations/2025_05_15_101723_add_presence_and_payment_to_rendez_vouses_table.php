<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('rendez_vouses', function (Blueprint $table) {
            $table->enum('arrive', ['oui', 'non'])->nullable()->after('statut');
            $table->decimal('montant_paye', 8, 2)->nullable()->after('arrive');
        });
    }

    public function down(): void
    {
        Schema::table('rendez_vouses', function (Blueprint $table) {
            $table->dropColumn('arrive');
            $table->dropColumn('montant_paye');
        });
    }
};
