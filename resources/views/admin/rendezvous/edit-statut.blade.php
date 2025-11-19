@extends('layouts.admin')

@section('content')
<div class="max-w-xl mx-auto p-6 bg-white shadow rounded">
    <h2 class="text-2xl font-bold mb-4">Modifier le statut </h2>

    <form action="{{ route('admin.rendezvous.saveStatut', $rendezvous->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <label for="statut" class="block text-sm font-medium">Statut :</label>
            <select name="statut" id="statut" class="mt-1 block w-full border rounded p-2">
                <option value="attente" {{ $rendezvous->statut == 'attente' ? 'selected' : '' }}>En attente</option>
                <option value="confirme" {{ $rendezvous->statut == 'confirme' ? 'selected' : '' }}>Confirmé</option>
                <option value="refuse" {{ $rendezvous->statut == 'refuse' ? 'selected' : '' }}>Refusé</option>
                <option value="annule" {{$rendezvous->statut == 'annule' ? 'selected' : '' }}>Annulé</option>
            </select>
        </div>

        
        
        <div class="flex justify-end">
            <a href="{{ route('back') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded mr-2">Annuler</a>
            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded">Enregistrer</button>
        </div>
    </form>
</div>




@endsection
