<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::dropIfExists('paiements'); // بدّل paiements بالاسم الصحيح ديال الطابل
    }

    public function down(): void
    {
        // تقدر ترجع الطابل هنا إلا بغيتي، مثلا:
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // زيد الأعمدة الأخرى هنا إذا بغيت
        });
    }
};
