@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white shadow-lg rounded-lg p-8">
    <h2 class="text-3xl font-semibold text-gray-800 mb-6 border-b pb-2">Détails d'abonnement</h2>

    <div class="space-y-4 text-gray-700 text-lg">
    <div class="flex justify-between items-center border-b pb-2">
        <span class="font-medium text-gray-600">Nom :</span>
        <span class="font-semibold">{{ $payment->user ? $payment->user->name : "I" }}</span>
    </div> 

    <div class="flex justify-between items-center border-b pb-2">
        <span class="font-medium text-gray-600">Montant :</span>
        <span class="font-semibold">{{ $payment->amount }} DH</span>
    </div>
  <!-- Téléphone -->
<div class="flex justify-between items-center border-b pb-2">
    <span class="font-medium text-gray-600">Téléphone :</span>
    <span class="font-semibold">{{ $payment->phone ?? "-" }}</span>
</div>

<!-- Adresse complète -->
<div class="flex justify-between items-center border-b pb-2">
    <span class="font-medium text-gray-600">Adresse :</span>
    <span class="font-semibold">
        {{ $payment->address ?? "" }}, {{ $payment->city ?? "" }} 
    </span>
</div>
    </div>
    
    <div class="flex justify-between items-center border-b pb-2">
        <span class="font-medium text-gray-600">Date :</span>
        <span class="font-semibold">{{ $payment->created_at->format('d/m/Y H:i') }}</span>
    </div>
    <div class="flex justify-between items-center">
        <span class="font-medium text-gray-600">Statut :</span>
<span class="px-3 py-1 rounded-full 
    @if($payment->status === 'validated') bg-green-100 text-green-800
    @elseif(in_array($payment->status, ['pending','en_cours'])) bg-yellow-100 text-yellow-800
    @elseif(in_array($payment->status, ['failed','échoué','echoue'])) bg-red-100 text-red-800
    @else bg-gray-200 text-gray-800
    @endif">
    @if($payment->status === 'validated')
        Validé
    @elseif(in_array($payment->status, ['pending','en_cours']))
        En cours
    @elseif(in_array($payment->status, ['failed','échoué','echoue']))
        Échoué
    @else
        {{ $payment->status }}
    @endif
</span>
<form action="{{ route('admin.paiements.update_status', $payment->id) }}" method="POST" class="flex items-center gap-3 mt-4">
    @csrf
    @method('PATCH')

    <select name="status" class="border rounded-full px-4 py-2 text-gray-700 font-semibold bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
        <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>En cours</option>
        <option value="validated" {{ $payment->status == 'validated' ? 'selected' : '' }}>Validé</option>
        <option value="failed" {{ $payment->status == 'failed' ? 'selected' : '' }}>Échoué</option>
    </select>

    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-full font-semibold hover:bg-indigo-700 transition">
        Mettre à jour
    </button>
</form>


    </div>
</div>

<div class="mt-8 text-right">
    <a href="{{ route('admin.paiements') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
        ← Retour au paiements
    </a>
</div>
</div>
@endsection