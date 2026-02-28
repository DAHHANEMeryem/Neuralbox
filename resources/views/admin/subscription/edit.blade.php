@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white shadow-lg rounded-lg p-8">
    <h2 class="text-3xl font-semibold text-gray-800 mb-6 border-b pb-2">Détails d'abonnment</h2>

    <form method="POST" action="{{ route('admin.subscription_update', $subscription->id) }}">
        @csrf
        @method('PATCH')
        {{-- date --}}
        <!-- <div class="mb-6">
            <label for="statut" class="block text-sm font-medium text-gray-700 mb-2">Date du rendez-vous</label>
            <input type="date" name="date" value="{{  \Carbon\Carbon::parse($subscription->date)->format('Y-m-d') }}">
        </div> -->
        
        <div class="mb-6">
            <label for="user" class="block text-sm font-medium">Utilisateur :</label>
            <select name="user" id="user" class="mt-1 block w-full border rounded p-2">
                @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ $user->id == $subscription->user->id ? 'selected' : '' }} >{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-6">
            <label for="type" class="block text-sm font-medium">Pack :</label>
            <select name="type" id="type" class="mt-1 block w-full border rounded p-2">
                <option value="neuralbox" {{ $subscription->type == 'neuralbox' ? 'selected' : '' }}>Neuralbox</option>
                    <option value="silver" {{ $subscription->type == 'silver' ? 'selected' : '' }}>Neuralbox</option>
                <option value="golden" {{ $subscription->type == 'golden' ? 'selected' : '' }}>Golden</option>
            </select>
        </div>
        

        <div class="flex justify-end">
            <a href="{{ route('admin.subscriptions') }}" class="mr-4 inline-block px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">
                ← Annuler
            </a>
           
        </div>
    </form>
</div>

<div class="mt-8 text-right">
    <a href="{{ route('admin.subscriptions') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
        ← Retour aux abonnements
    </a>
</div>
</div>
@endsection