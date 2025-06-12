@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto mt-12 bg-white p-8 rounded-lg shadow-lg">
    <h2 class="text-3xl font-semibold text-gray-800 mb-6 border-b pb-2">🛠️ Modifier le Statut du Rendez-vous</h2>
    
    <form method="POST" action="{{ route('rendezvous.update', $rdv->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label for="statut" class="block text-sm font-medium text-gray-700 mb-2">📌 Statut du rendez-vous</label>
            <select name="statut" id="statut" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-300 focus:border-indigo-400">
                <option value="attente" {{ $rdv->statut == 'attente' ? 'selected' : '' }}>🕒 En attente</option>
                <option value="confirme" {{ $rdv->statut == 'confirme' ? 'selected' : '' }}>✅ Accepté</option>
                <option value="annule" {{ $rdv->statut == 'annule' ? 'selected' : '' }}>❌ Refusé</option>
            </select>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.dashboard') }}" class="mr-4 inline-block px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">
                ← Annuler
            </a>
            <button type="submit" class="inline-block px-6 py-2 bg-green-800 text-black font-semibold rounded hover:bg-green-700 transition">
                💾 Mettre à jour
            </button>
        </div>
    </form>
</div>

@endsection
