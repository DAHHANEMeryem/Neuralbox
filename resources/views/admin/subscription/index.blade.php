@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    
    <div class="bg-gray-50 rounded-xl p-6 gap-x-4 flex flex-col md:flex-row md:justify-between shadow-md">
        <div class="w-full md:max-w-1/2">
            <h2 class="text-2xl font-semibold text-indigo-600 mb-4">Abonnes Neuralbox (2300 DH)</h2>
            @include('admin.paiements.table', ['subscriptions' => $neuralboxs])
        </div>
        <div class="w-full md:max-w-1/2">
            <h2 class="text-2xl font-semibold text-indigo-600 mb-4">Abonnes Golden (3200 DH)</h2>
            @include('admin.paiements.table', ['subscriptions' => $goldens])
        </div>
    </div>
</div>
@endsection
