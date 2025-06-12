<table class="table-auto w-full border mb-8">
    <thead class="bg-gray-100">
        <tr>
            <th class="px-4 py-2">ID</th>
            <th class="px-4 py-2">Utilisateur</th>
            <th class="px-4 py-2">Montant</th>
            <th class="px-4 py-2">Méthode</th>
            <th class="px-4 py-2">Statut</th>
            <th class="px-4 py-2">Date</th>
        </tr>
    </thead>
    <tbody>
        @forelse($paiements as $paiement)
        <tr class="border-b">
            <td class="px-4 py-2">{{ $paiement->id }}</td>
            <td class="px-4 py-2">{{ $paiement->user->name ?? 'N/A' }}</td>
            <td class="px-4 py-2">{{ number_format($paiement->amount, 2) }} MAD</td>
            <td class="px-4 py-2">{{ ucfirst($paiement->method) }}</td>
            <td class="px-4 py-2">{{ ucfirst($paiement->status) }}</td>
            <td class="px-4 py-2">{{ $paiement->created_at->format('d/m/Y') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center px-4 py-2 text-gray-500">Aucun paiement trouvé.</td>
        </tr>
        @endforelse
    </tbody>
</table>
