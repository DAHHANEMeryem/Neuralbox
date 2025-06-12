@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
   <div class="flex items-center justify-between mb-8">
  <h1 class="text-3xl font-bold text-indigo-700">
    Tableau des Paiements
  </h1>
  <a href="{{ route('admin.export.paiements.pdf') }}" 
     class="bg-blue-500 hover:bg-blue-600 transition-colors text-white px-4 py-2 rounded shadow-sm font-semibold whitespace-nowrap">
    📄 Exporter en PDF
  </a>
</div>


    <!-- Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-indigo-100 hover:scale-105 transition-transform duration-300">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Total des paiements</h2>
            <p class="text-2xl font-bold text-indigo-600">{{ number_format($total, 2) }} MAD</p>
        </div>
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-green-100 hover:scale-105 transition-transform duration-300">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Paiements réussis</h2>
            <p class="text-2xl font-bold text-green-600">{{ $successCount }} Paiements</p>
        </div>
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-red-100 hover:scale-105 transition-transform duration-300">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Paiements échoués</h2>
            <p class="text-2xl font-bold text-red-600">{{ $failCount }} Paiements</p>
        </div>
    </div>

    <!-- Listes des paiements -->
    <div class="bg-gray-50 rounded-xl p-6 shadow-md">
        <h2 class="text-2xl font-semibold text-indigo-600 mb-4">Paiements 2300 MAD</h2>
        @include('admin.paiements.table', ['paiements' => $paiements_2300])

        <h2 class="text-2xl font-semibold text-indigo-600 mt-10 mb-4">Paiements 3200 MAD</h2>
        @include('admin.paiements.table', ['paiements' => $paiements_3200])
    </div>
</div>
@endsection


        <!-- Pagination -->
        