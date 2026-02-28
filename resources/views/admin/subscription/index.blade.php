@extends('layouts.admin')

@section('content')
<div class="container mx-auto md:px-4 md:py-8 space-y-8">

    {{-- Neuralbox --}}
    <div class="bg-gray-50 rounded-xl p-4 md:p-6 shadow-md">
        <h2 class="text-lg md:text-2xl font-semibold text-indigo-600 mb-4">
            Abonnés Neuralbox (2300 DH)
        </h2>

        @if($neuralboxs->count() > 0)
            <table class="min-w-full bg-white shadow rounded-lg overflow-hidden">
                <thead class="bg-indigo-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Utilisateur</th>
                        <th class="px-4 py-2 text-left">Date d'inscription</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($neuralboxs as $sub)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $sub->user->name }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($sub->user->created_at)->format('d/m/Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-2">
                {{ $neuralboxs->links() }}
            </div>
        @else
            <p class="text-gray-500">Aucun abonné Neuralbox pour le moment.</p>
        @endif
    </div>

    {{-- Golden --}}
    <div class="bg-gray-50 rounded-xl p-4 md:p-6 shadow-md">
        <h2 class="text-lg md:text-2xl font-semibold text-indigo-600 mb-4">
            Abonnés Golden (3200 DH)
        </h2>

        @if($goldens->count() > 0)
            <table class="min-w-full bg-white shadow rounded-lg overflow-hidden">
                <thead class="bg-indigo-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Utilisateur</th>
                        <th class="px-4 py-2 text-left">Date d'inscription</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($goldens as $sub)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $sub->user->name }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($sub->user->created_at)->format('d/m/Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-2">
                {{ $goldens->links() }}
            </div>
        @else
            <p class="text-gray-500">Aucun abonné Golden pour le moment.</p>
        @endif
    </div>

</div>
@endsection