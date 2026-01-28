@extends('layouts.admin')

@section('content')
<div class="container mx-auto md:px-4 md:py-8">
    <div class="flex items-center flex-col md:flex-row justify-between mb-8">
        <h1 class="text-lg md:text-3xl font-bold text-indigo-700">
            Tableau des Paiements
        </h1>
        <a href="{{ route('admin.export.paiements.pdf') }}"
            class="bg-blue-500 hover:bg-blue-600 transition-colors text-white px-4 py-2 rounded shadow-sm font-semibold whitespace-nowrap">
            📄 Exporter en PDF
        </a>
    </div>


    <!-- Statistiques -->
    <div class="grid grid-cols-2 md:grid-cols-3 gap-2 md:gap-6 mb-12">
        <div class="bg-white rounded-2xl shadow-lg p-2 md:p-6 border border-green-100 hover:scale-105 transition-transform duration-300">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Paiements réussis</h2>
            <p class="text-base md:text-2xl font-bold text-green-600">{{ $successCount }} Paiements</p>
        </div>
        <div class="bg-white rounded-2xl shadow-lg p-2 md:p-6 border border-green-100 hover:scale-105 transition-transform duration-300">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Paiements en cours</h2>
            <p class="text-base md:text-2xl font-bold text-sky-400">{{ $pendingCount }} Paiements</p>
        </div>
        <div class="bg-white rounded-2xl shadow-lg p-2 md:p-6 border border-red-100 hover:scale-105 transition-transform duration-300">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Paiements échoués</h2>
            <p class="text-base md:text-2xl font-bold text-red-600">{{ $failCount }} Paiements</p>
        </div>
        <div class="bg-white rounded-2xl shadow-lg p-2 md:p-6 border border-indigo-100 hover:scale-105 transition-transform duration-300">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Total des paiements valider</h2>
            <p class="text-base md:text-2xl font-bold text-indigo-600">{{ number_format($total, 2) }} DH</p>
        </div>
        <div class="bg-white rounded-2xl shadow-lg p-2 md:p-6 border border-indigo-100 hover:scale-105 transition-transform duration-300">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Paiements valider ce mois</h2>
            <p class="text-base md:text-2xl font-bold text-indigo-600">{{ number_format($monthlyRevenue, 2) }} DH</p>
        </div>
    </div>
    <table class=" block md:table  w-full border-collapse rounded-lg overflow-x-scroll md:overflow-hidden shadow-lg">
    <thead class="bg-gradient-to-r from-indigo-500 to-indigo-700 text-white">
        <tr>
            <!-- <th class="px-6 py-3 text-center font-semibold">ID</th> -->
            <th class="px-2 md:px-6 py-1 md:py-3 text-center font-semibold">Utilisateur</th>
            <th class="px-2 md:px-6 py-1 md:py-3 text-center font-semibold">Montant</th>
            <th class="px-2 md:px-6 py-1 md:py-3 text-center font-semibold">Statut</th>
            <th class="px-2 md:px-6 py-1 md:py-3 text-center font-semibold">Méthod</th>
            <th class="px-2 md:px-6 py-1 md:py-3 text-center font-semibold">Date</th>
            {{-- <th class="px-6 py-3 text-center font-semibold">Reçu</th> --}}
            {{-- <th class="px-6 py-3 text-center font-semibold"></th> --}}
            <!-- <th class="px-6 py-3 text-center font-semibold">Méthode</th>-->
        </tr>
    </thead>
    <tbody class="bg-white">
        @forelse($paiements as $paiement)
        <tr onclick="goto(`{{route('admin.paiements.show',$paiement->id)}}`)" class="border-b cursor-pointer hover:bg-indigo-50 transition-colors duration-200">
            <!-- <td class="px-6 py-4 text-center text-gray-700">{{ $paiement->id }}</td> -->
            <td class="px-2 md:px-6 py-1 md:py-4 text-center text-gray-700">{{ $paiement->user->name ?? 'N/A' }}</td>
            <td class="px-2 md:px-6 py-1 md:py-4 text-center font-semibold text-indigo-600">{{ number_format($paiement->amount, 2) }} MAD</td>
            <td class="px-2 md:px-6 py-1 md:py-4 text-center font-semibold">
                @if(strtolower($paiement->status) === 'validated')
                <span class="text-green-600 bg-green-100 px-3 py-1 rounded-full">Validé</span>
                @elseif(strtolower($paiement->status) === 'pending')
                <span class="text-red-600 bg-red-100 px-3 py-1 rounded-full">En cours</span>
                @else
                <span class="text-gray-600 bg-gray-100 px-3 py-1 rounded-full capitalize">Echoué</span>
                @endif
            </td>
            <td class="px-2 md:px-6 py-1 md:py-4 text-center capitalize text-gray-600">{{ $paiement->method }}</td>
            {{-- <td class="px-6 py-4 text-center capitalize text-gray-600"><a target="_blank" href="{{ route('secure.file',['id' => $paiement->id,'type' => 'paiment']) }}">{{ $paiement->receipt ? 'voit Reçu' : 'Pas de reçu' }}</a></td> --}}
            <td class="px-2 md:px-6 py-1 md:py-4 text-center text-gray-500">{{ $paiement->created_at->format('d/m/Y') }}</td>
            {{-- <td class="px-6 py-4 text-center text-gray-500"><a href="{{ route('admin.subscription_edit',$paiement) }}" class="p-2"><i class="fa fa-pen text-green-500"></i></a></td> --}}
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center py-6 text-gray-500 italic">Aucun paiement trouvé.</td>
        </tr>
        @endforelse
        @if ($paiements->links())
        <tr>
            <td class="">{{ $paiements->links() }}</td>
        </tr>
        @endif

    </tbody>
</table>


<!-- Listes des paiements -->
{{-- <div class="bg-gray-50 rounded-xl p-6 shadow-md">
    <h2 class="text-2xl font-semibold text-indigo-600 mb-4">Abonnes Neuralbox (2300 DH)</h2>
    @include('admin.paiements.table', ['subscriptions' => $neuralboxs])

        <h2 class="text-2xl font-semibold text-indigo-600 mt-10 mb-4">Abonnes Golden (3200 DH)</h2>
        @include('admin.paiements.table', ['subscriptions' => $goldens])
    </div> --}}
</div>
@endsection
<script>
    function goto(url) {
        window.location.href = url;
    }
</script>
{{-- @section('scripts')
<script>
    $(document).ready(function() {
        // 1. Gérer le clic sur la cellule de statut
        $('.status-cell').on('click', function() {
            const paiementId = $(this).data('id');
            const currentStatus = $(this).data('current-status');
            let newStatus = '';
            let confirmationMessage = '';

            // Logique pour déterminer le nouveau statut (bascule entre confirmed et not_confirmed, par exemple)
            if (currentStatus === 'not_confirmed' || currentStatus === 'paused') {
                newStatus = 'confirmed';
                confirmationMessage = `Voulez-vous **CONFIRMER** l'abonnement ID **${paiementId}** ?`;
            } else if (currentStatus === 'confirmed') {
                newStatus = 'not_confirmed';
                confirmationMessage = `Voulez-vous changer le statut de l'abonnement ID **${paiementId}** à **NON CONFIRMÉ** ?`;
            } else {
                // Si vous avez d'autres statuts, adaptez la logique ici.
                return;
            }

            // 2. Module de validation (Confirmation)
            if (confirm(confirmationMessage)) {
                // 3. Appel AJAX si confirmé
                updateStatus(paiementId, newStatus, $(this));
            }
        });

        // Fonction d'appel AJAX
        function updateStatus(id, newStatusValue, $element) {
            // Le jeton CSRF est essentiel pour la sécurité dans Laravel
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Assurez-vous d'avoir une route définie dans Laravel pour gérer cette requête (par exemple: /subscriptions/{id}/update-status)
            $.ajax({
                url: `/subscriptions/${id}/update-status`, // **<-- Mettez votre URL de route Laravel ici**
                type: 'POST', // ou PUT/PATCH selon votre route
                data: {
                    _token: csrfToken, // Jeton CSRF
                    status: newStatusValue
                },
                success: function(response) {
                    // 4. Mise à jour de l'interface utilisateur en cas de succès
                    if (response.success) {
                        alert('Statut mis à jour avec succès !');

                        // Mise à jour de l'attribut data-current-status
                        $element.data('current-status', newStatusValue);

                        // Mise à jour du contenu affiché dans la cellule
                        let statusText = '';
                        let statusClass = '';

                        if (newStatusValue === 'confirmed') {
                            statusText = 'Confirmer';
                            statusClass = 'text-green-600 bg-green-100';
                        } else if (newStatusValue === 'not_confirmed') {
                            statusText = 'Pas Confirmer';
                            statusClass = 'text-red-600 bg-red-100';
                        } else {
                            statusText = 'Pauser';
                            statusClass = 'text-gray-600 bg-gray-100';
                        }

                        // Remplacer le contenu du span
                        $element.html(`<span class="${statusClass} px-3 py-1 rounded-full capitalize">${statusText}</span>`);

                    } else {
                        alert('Erreur lors de la mise à jour du statut.');
                    }
                },
                error: function(xhr) {
                    // Afficher l'erreur en cas d'échec de la requête
                    console.error(xhr.responseText);
                    alert('Une erreur est survenue lors de la communication avec le serveur.');
                }
            });
        }
    });
</script>
@endsection --}}


<!-- Pagination -->