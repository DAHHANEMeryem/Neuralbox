@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white shadow-lg rounded-lg p-8">
    <h2 class="text-3xl font-semibold text-gray-800 mb-6 border-b pb-2">Détails d'abonnment</h2>

    <div class="space-y-4 text-gray-700 text-lg">
    <div class="flex justify-between items-center border-b pb-2">
        <span class="font-medium text-gray-600">Nom :</span>
        <span class="font-semibold">{{ $subscription->user ? $subscription->user->name : "I" }}</span>
    </div> 
    <div class="flex justify-between items-center border-b pb-2">
        <span class="font-medium text-gray-600">Utilisateur :</span>
        <span class="font-semibold">{{ $subscription->user->numero}}</span>
    </div>
    <div class="flex justify-between items-center border-b pb-2">
        <span class="font-medium text-gray-600">Type :</span>
        <span class="font-semibold">{{ $subscription->type }}</span>
    </div>
    <div class="flex justify-between items-center border-b pb-2">
        <span class="font-medium text-gray-600">Date :</span>
        <span class="font-semibold">{{ \Carbon\Carbon::parse($subscription->date)->format('d/m/Y H:i') }}</span>
    </div>
    <div class="flex justify-between items-center">
        <span class="font-medium text-gray-600">Statut :</span>
        <span class="px-3 py-1 rounded-full 
                @if($subscription->status == 'not_confirmed') bg-yellow-700 text-gray-50 
                @elseif($subscription->status == 'confirmed') bg-green-100 text-green-800 
                @elseif($subscription->status == 'confirmed') bg-red-400 text-gray-50 
                @else bg-gray-200 text-gray-800 @endif">
            {{ $subscription->status == 'confirmed' ? 'Confirmé' : 'Pas' }}
        </span>
    </div>
</div>

<div class="mt-8 text-right">
    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
        ← Retour au tableau de bord
    </a>
</div>
</div>
@endsection