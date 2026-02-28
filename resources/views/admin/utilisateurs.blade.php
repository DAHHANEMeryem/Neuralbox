@extends('layouts.admin')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="p-5">
    <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-blue-500 md:flex items-stretch md:items-center justify-between gap-4 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
        <div class="flex items-center gap-4 flex-shrink-0">
            <div class="rounded-full bg-blue-100 p-2 md:p-3 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="md:h-6 h-3 md:w-6 w-3 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Nombre total d'utilisateurs</p>
                <p class="text-2xl font-bold text-gray-800">{{ $totalUsers }}</p>
            </div>
        </div>
        <a href="{{ route('admin.export.pdf') }}"
            class="bg-blue-500 hover:bg-blue-600 transition-colors text-sm text-white px-4 py-2 rounded shadow-sm font-semibold whitespace-nowrap">
            📄 Exporter en PDF
        </a>
    </div>
</div>

<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">👥 Gestion des Utilisateurs (Parents)</h1>

    <!-- Tableau -->
    <div class="overflow-x-auto bg-white rounded shadow p-4">
        <table class="min-w-full table-auto">
            <thead>
                <tr>
                    <th class="px-4 py-2">Nom</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Date d'inscription</th>
                    <th class="px-4 py-2">Statut</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @foreach ($users as $user)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $user->name }}</td>
                    <td class="px-4 py-2">{{ $user->email }}</td>
                    <td class="px-4 py-2">{{ $user->created_at ? $user->created_at->format('d/m/Y') : 'Date inconnue' }}</td>
                    <td class="px-4 py-2">
                        @if($user->isOnline())
                            <span class="text-green-600 font-semibold">Actif</span>
                        @else
                            <span class="text-gray-500">Inactif</span>
                        @endif
                    </td>
                      <!-- ✅ Accès -->
   <td class="px-4 py-2">
    <span id="access-badge-{{ $user->id }}" 
          class="px-2 py-1 text-white rounded-full text-sm
          {{ $user->has_access ? 'bg-green-500' : 'bg-red-500' }}">
        {{ $user->has_access ? 'Oui' : 'Non' }}
    </span>
</td>
                    <td class="px-4 py-2 flex gap-2">
                        <!-- Bouton Donner l'accès -->
                        <form class="giveAccessForm" data-user-id="{{ $user->id }}">
                            @csrf
                            <button type="submit" class="text-purple-600 hover:underline">Donner l'accès</button>
                        </form>

                        <!-- Bouton Retirer l'accès -->
                        <form class="revokeAccessForm" data-user-id="{{ $user->id }}">
                            @csrf
                            <button type="submit" class="text-red-600 hover:underline">Retirer l'accès</button>
                        </form>
                    </td>
                    <td class="px-4 py-2">
    <button class="text-blue-600 hover:underline showDetailsBtn" 
        data-user='@json($user)'>
        Détails
    </button>
</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</div>
<!-- ✅ Modal pour afficher les détails d'un utilisateur -->
<div class="modal fade" id="userDetailsModal" tabindex="-1" aria-labelledby="userDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userDetailsModalLabel">Détails de l'utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body" id="userDetailsModalBody">
                <!-- Contenu injecté via JS -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Donner l'accès -->
<div class="modal fade" id="accessModal" tabindex="-1" aria-labelledby="accessModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="accessModalLabel">Détails de l'accès</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body" id="accessModalBody"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Retirer l'accès -->
<div class="modal fade" id="revokeAccessModal" tabindex="-1" aria-labelledby="revokeAccessModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="revokeAccessModalLabel">Retirer l'accès</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body" id="revokeAccessModalBody"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Bouton "Détails"
    $('.showDetailsBtn').on('click', function() {
        var user = $(this).data('user'); // Récupère les infos utilisateur
        
        // Générer le HTML des détails
        var html = `
            <p><strong>Nom:</strong> ${user.name}</p>
            <p><strong>Email:</strong> ${user.email}</p>
            <p><strong>Rôle:</strong> ${user.role ?? 'Utilisateur'}</p>
            <p><strong>Date d'inscription:</strong> ${user.created_at ? new Date(user.created_at).toLocaleDateString() : 'Inconnue'}</p>
        `;
        
        $('#userDetailsModalBody').html(html);

        // Ouvre le modal
        var detailsModal = new bootstrap.Modal(document.getElementById('userDetailsModal'));
        detailsModal.show();
    });
});
</script>
<script>
$(document).ready(function() {
    // Donner l'accès
    $('.giveAccessForm').on('submit', function(e) {
        e.preventDefault();
        var userId = $(this).data('user-id');
        var token = $(this).find('input[name="_token"]').val();

        $.ajax({
            url: '/utilisateurs/' + userId + '/access',
            type: 'POST',
            data: {_token: token},
            success: function(data) {
                // Mettre à jour le badge Accès
                $('#access-badge-' + userId)
                    .removeClass('bg-red-500')
                    .addClass('bg-green-500')
                    .text('Oui');

                // Afficher le modal
                $('#accessModalBody').html(`
                    <p>L'accès a été donné avec succès !</p>
                    <p>Détails : ${data.details ?? 'Aucune information supplémentaire'}</p>
                `);
                var modal = new bootstrap.Modal(document.getElementById('accessModal'));
                modal.show();
            },
            error: function() {
                alert('Erreur lors de l\'opération');
            }
        });
    });

    // Retirer l'accès
    $('.revokeAccessForm').on('submit', function(e) {
        e.preventDefault();
        var userId = $(this).data('user-id');
        var token = $(this).find('input[name="_token"]').val();

        $.ajax({
            url: '/utilisateurs/' + userId + '/revoke',
            type: 'POST',
            data: {_token: token},
            success: function(data) {
                // Mettre à jour le badge Accès
                $('#access-badge-' + userId)
                    .removeClass('bg-green-500')
                    .addClass('bg-red-500')
                    .text('Non');

                // Afficher le modal
                $('#revokeAccessModalBody').html(`
                    <p>L'accès a été retiré avec succès !</p>
                    <p>Détails : ${data.details ?? 'Aucune information supplémentaire'}</p>
                `);
                var modal = new bootstrap.Modal(document.getElementById('revokeAccessModal'));
                modal.show();
            },
            error: function() {
                alert('Erreur lors de l\'opération');
            }
        });
    });
});
</script>
@endpush