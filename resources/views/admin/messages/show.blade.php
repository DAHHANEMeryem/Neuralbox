@extends('layouts.admin')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
    <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-700 mb-6 flex items-center gap-2">📨 Détail du message</h2>

        <ul class="space-y-4 text-gray-800 text-sm">
            <li><span class="font-medium">👤 Nom :</span> {{ $message->nom }}</li>
            <li><span class="font-medium">👤 Prénom :</span> {{ $message->prenom }}</li>
            <li><span class="font-medium">✉️ Email :</span> {{ $message->email }}</li>
            <li><span class="font-medium">📞 Téléphone :</span> {{ $message->telephone }}</li>
            <li><span class="font-medium">🕒 Date :</span> {{ $message->created_at->format('d/m/Y H:i') }}</li>
            <li>
                <span class="font-medium">📝 Message :</span>
                <div class="mt-1 p-4 bg-gray-100 rounded-md text-gray-700 whitespace-pre-line">{{ $message->message }}</div>
            </li>
        </ul>

        <div class="mt-6">
            <a href="{{ route('admin.messages.index') }}"
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm shadow">
                ⬅ Retour à la liste
            </a>
        </div>

    </div>
    <br>
     <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-6">
     <h3 class="text-lg font-semibold mt-6 mb-2">📨 Autres messages de cette personne :</h3>

@if($autresMessages->isEmpty())
    <p class="text-gray-500">Aucun autre message trouvé pour cette personne.</p>
@else
    <ul class="space-y-2">
        @foreach($autresMessages as $msg)
            <li class="border p-3 rounded shadow-sm bg-gray-50">
                <div><strong>Envoyé le :</strong> {{ $msg->created_at->format('d/m/Y H:i') }}</div>
                <div><strong>Message :</strong> {{ Str::limit($msg->message, 100) }}</div>
                <a href="{{ route('admin.messages.show', $msg->id) }}" class="text-blue-600 hover:underline text-sm">Voir les détails</a>
            </li>
        @endforeach
    </ul>
@endif
     </div>
   
</div>


@endsection
