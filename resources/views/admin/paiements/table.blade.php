<table class="min-w-full border-collapse rounded-lg overflow-hidden shadow-lg">
    <thead class="bg-gradient-to-r from-indigo-500 to-indigo-700 text-white">
        <tr>
            @foreach($columns as $column)
                <th class="px-1 md:px-6 py-2 md:py-3 text-center font-semibold">
                    {{ ucfirst($column) }}
                </th>
            @endforeach
            <th class="px-1 md:px-6 py-2 md:py-3 text-center font-semibold"></th>
        </tr>
    </thead>
    <tbody class="bg-white">
        @forelse($subscriptions as $paiement)
        <tr onclick="goto(`{{route('subscriptions.show',$paiement->id)}}`)" class="border-b cursor-pointer hover:bg-indigo-50 transition-colors duration-200">
            @foreach($columns as $column)
                <td class="px-2 md:px-6 py-1 md:py-4 text-sm text-center text-gray-700">
                    @if($column === 'user')
                        {{ $paiement->user->name ?? 'N/A' }}
                    @elseif($column === 'status')
                        @if(strtolower($paiement->status) === 'confirmed')
                            <span class="text-green-600 bg-green-100 px-3 py-1 rounded-full">Confirmer</span>
                        @elseif(strtolower($paiement->status) === 'not_confirmed')
                            <span class="text-red-600 bg-red-100 px-3 py-1 rounded-full">Pas Confirmer</span>
                        @else
                            <span class="text-gray-600 bg-gray-100 px-3 py-1 rounded-full capitalize">Pauser</span>
                        @endif
                    @elseif($column === 'date')
                        {{ $paiement->created_at->format('d/m/Y') }}
                    @elseif($column === 'amount')
                        {{ number_format($paiement->amount, 2) }} MAD
                    @endif
                </td>
            @endforeach
            <td class="md:px-6 md:py-4 text-center text-gray-500">
                <a href="{{ route('admin.subscription_edit',$paiement) }}" class="p-2">
                    <i class="fa fa-pen text-green-500"></i>
                </a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="{{ count($columns) + 1 }}" class="text-center py-6 text-gray-500 italic">Aucun paiement trouvé.</td>
        </tr>
        @endforelse
        <tr>
            <td class="p-2 md:p-4" colspan="{{ count($columns) + 1 }}">
                {{ $subscriptions->links() }}
            </td>
        </tr>
    </tbody>
</table>

<script>
    function goto(url) {
        window.location.href = url;
    }
</script>
