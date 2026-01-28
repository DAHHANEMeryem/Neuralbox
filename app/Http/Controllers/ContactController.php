<?php

namespace App\Http\Controllers;

use App\Mail\contactMail;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $layout = auth()->user()->is_admin ? 'layouts.admin' : 'layouts.app';
        $user = auth()->user();


        if (!$user->is_admin) {
            // Utilisateur normal : conversation avec admin
            $adminIds = User::where('is_admin', true)->pluck('id');
            // important pour réindexer la collection

            $messages = Contact::where(function ($q) use ($user, $adminIds) {
                $q->where('sender_id', $user->id)->whereIn('receiver_id', $adminIds);
            })->orWhere(function ($q) use ($user, $adminIds) {
                $q->whereIn('sender_id', $adminIds)->where('receiver_id', $user->id);
            })->orderBy('created_at')->get();

            return view('contact.index', compact('messages', 'layout'));
        } else {
            // Admin : liste des utilisateurs avec conversations
            $search = $request->input('search');
            $query = User::where('is_admin', false);

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%");
                });
            }

            // Récupérer les utilisateurs avec leur dernier message
            $users = $query->with(['sentContacts' => function ($q) {
                $q->latest()->limit(1);
            }, 'receivedContacts' => function ($q) {
                $q->latest()->limit(1);
            }])->get()->map(function ($user) {
                // Trouver le dernier message (envoyé ou reçu)
                $lastSent = $user->sentContacts->first();
                $lastReceived = $user->receivedContacts->first();

                $latest = collect([$lastSent, $lastReceived])
                    ->filter()
                    ->sortByDesc('created_at')
                    ->first();

                $user->latest_message = $latest;
                return $user;
            })->sortByDesc(function ($user) {
                return optional($user->latest_message)->created_at;
            })->values(); // pour réindexer proprement



            // Messages récents par défaut
            $defaultMessages = Contact::where(function ($q) {
                $q->where('sender_id', auth()->id())
                    ->orWhere('receiver_id', auth()->id());
            })->with(['sender', 'receiver'])
                ->orderBy('created_at', 'desc')
                ->limit(20)
                ->get()
                ->reverse(); // Pour avoir l'ordre chronologique

            return view('contact.index', compact('users', 'layout', 'defaultMessages'));
        }
    }

    public function sendToAdmin(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $admin = User::where('is_admin', true)->first();

        if (!$admin) {
            return back()->withErrors(['error' => 'Aucun administrateur trouvé.']);
        }


        Contact::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $admin->id,
            'message' => $request->message,
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => [
                    'message' => $request->message,
                    'created_at' => now(),
                    'sender_id' => auth()->id()
                ]
            ]);
        }

        return redirect()->route('messagerie.index')->with('success', 'Message envoyé à l\'administrateur.');
    }

    public function showConversation(User $user)
    {
        $admin = auth()->user();

        if (!$admin->is_admin) abort(403);

        $messages = Contact::where(function ($q) use ($admin, $user) {
            $q->where('sender_id', $admin->id)->where('receiver_id', $user->id);
        })->orWhere(function ($q) use ($admin, $user) {
            $q->where('sender_id', $user->id)->where('receiver_id', $admin->id);
        })->with(['sender', 'receiver'])
            ->orderBy('created_at')
            ->get();

        return view('contact.conversation', compact('messages', 'user'));
    }

    public function sendMessageToUser(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'user_id' => 'required|exists:users,id',
        ]);

        $message = Contact::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->user_id,
            'message' => $request->message,
        ]);

        // Charger les relations pour la réponse JSON
        $message->load(['sender', 'receiver']);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'sender_name' => auth()->user()->name
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => "Message envoyé avec succès."
        ]);

        // return back()->with('success', 'Message envoyé avec succès.');
    }

    public function getAllMessages()
    {
        $admin = auth()->user();

        if (!$admin->is_admin) {
            return response()->json(['success' => false, 'error' => 'Non autorisé'], 403);
        }

        // Messages récents où l'admin est impliqué
        $messages = Contact::where(function ($q) use ($admin) {
            $q->where('sender_id', $admin->id)
                ->orWhere('receiver_id', $admin->id);
        })->with(['sender', 'receiver'])
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get()
            ->reverse(); // Ordre chronologique

        return response()->json([
            'success' => true,
            'messages' => $messages
        ]);
    }

    public function sendGeneralMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $admin = auth()->user();

        if (!$admin->is_admin) {
            return response()->json(['success' => false, 'error' => 'Non autorisé'], 403);
        }

        $users = \App\Models\User::where('id', '!=', $admin->id)->get(); // Exclure l’admin lui-même

        foreach ($users as $user) {
            Contact::create([
                'sender_id' => $admin->id,
                'receiver_id' => $user->id,
                'message' => $request->message,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => $request->message,
            'sender_name' => $admin->name,
            'total_recipients' => $users->count()
        ]);
    }

    public function getUserMessages(User $user)
    {
        try {
            $currentUser = auth()->user();

            $messages = Contact::where(function ($query) use ($user, $currentUser) {
                $query->where('sender_id', $currentUser->id)
                    ->where('receiver_id', $user->id);
            })
                ->orWhere(function ($query) use ($user, $currentUser) {
                    $query->where('sender_id', $user->id)
                        ->where('receiver_id', $currentUser->id);
                })
                ->with(['sender', 'receiver'])
                ->orderBy('created_at')
                ->get();

            return response()->json([
                'success' => true,
                'messages' => $messages,
                'user' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function getGeneralMessages()
    {
        $messages = Contact::whereNull('receiver_id')
            ->with('sender')
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'messages' => $messages
        ]);
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required',
            'email' => 'required|email',
            'topic' => 'required',
            'message' => 'required',
            ]);

        // Send to your own email address
        Mail::to('omarmalki169@gmail.com')->send(new contactMail($validated));

        return back()->with('success', 'Message sent successfully!');
    }
}
