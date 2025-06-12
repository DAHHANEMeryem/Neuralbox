@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-semibold mb-4">Paiements</h1>

        <!-- Filtrage -->
        <div class="mb-4 flex items-center space-x-4">
            <form action="{{ route('admin.paiements') }}" method="GET" class="flex space-x-4">
                <input type="text" name="user" placeholder="Nom de l'utilisateur" class="px-4 py-2 border rounded" value="{{ request('user') }}">
                <select name="status" class="px-4 py-2 border rounded">
                    <option value="">Status</option>
                    <option value="success" {{ request('status') == 'success' ? 'selected' : '' }}>Succès</option>
                    <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Échoué</option>
                </select>
                <input type="date" name="from" class="px-4 py-2 border rounded" value="{{ request('from') }}">
                <input type="date" name="to" class="px-4 py-2 border rounded" value="{{ request('to') }}">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Filtrer</button>
            </form>
        </div>

        <!-- Statistiques -->
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div class="bg-gray-200 p-4 rounded">
                <h2 class="font-semibold">Total des paiements</h2>
                <p>{{ number_format($total, 2) }} €</p>
            </div>
            <div class="bg-gray-200 p-4 rounded">
                <h2 class="font-semibold">Paiements réussis</h2>
                <p>{{ $successCount }} Paiements</p>
            </div>
            <div class="bg-gray-200 p-4 rounded">
                <h2 class="font-semibold">Paiements échoués</h2>
                <p>{{ $failCount }} Paiements</p>
            </div>
        </div>

      

<div class="container mx-auto p-6">

    <h2 class="text-2xl font-bold mb-4">Paiements 2300 MAD</h2>
    @include('admin.paiements.table', ['paiements' => $paiements_2300])

    <h2 class="text-2xl font-bold mb-4 mt-10">Paiements 3200 MAD</h2>
    @include('admin.paiements.table', ['paiements' => $paiements_3200])

    
</div>
@endsection


        <!-- Pagination -->
        