<?php

use App\Models\Message;
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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email');
            $table->string('telephone');
            $table->text('message');
            $table->boolean('destinataire_id')->nullable()->default(false);
            $table->boolean('lu')->nullable()->default(false);
            $table->timestamp('date')->useCurrent();
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
        
    }
    
    public function markAsRead($id)
    {
        $message = Message::findOrFail($id);
        $message->is_read = true;
        $message->save();

        return response()->json(['success' => true]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
