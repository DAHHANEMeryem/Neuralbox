<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    
   public function index()

{
      $totalMessages = Message::all();
    $messages = Message::all();
//    $allMessages = Message::count();
    $unreadMessages = Message::where('is_read', false)->get();
    $readMessages = Message::where('is_read', true)->get();
    return view('admin.messages.index', compact('unreadMessages','messages', 'readMessages','totalMessages'
    ));
}

public function show($id)
{
    $message = Message::findOrFail($id);
     $autresMessages = Message::where('email', $message->email)
                             ->where('id', '!=', $message->id)
                             ->latest()
                             ->get();
    return view('admin.messages.show', compact('message','autresMessages'));
}

public function markAsRead($id)
{
    $message = Message::findOrFail($id);
    $message->is_read = true;
    $message->save();
    return redirect()->back()->with('success', 'Message marqué comme lu.');
}

public function destroy($id)
{
    $message = Message::findOrFail($id);
    $message->delete();
    return redirect()->back()->with('success', 'Message supprimé.');
}


}
