<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Message;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    // Schema::table('messages', function (Blueprint $table) {
    //     $table->boolean('is_read')->default(false)->after('message');
    // });
}
// public function markAsRead($id)
// {
//     $message = Message::findOrFail($id);
//     $message->is_read = true;
//     $message->save();

//     return response()->json(['success' => true]);
// }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('messages', function (Blueprint $table) {
        //     //
        // });
    }
};
