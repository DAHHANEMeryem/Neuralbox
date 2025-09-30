@extends('layouts.admin')

@section('content')
<!-- En-tête avec style amélioré -->


<!-- Contenu des statistiques -->
<div class="p-5">
    <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-blue-500 flex items-center justify-between gap-4 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
        <div class="flex items-center gap-4 flex-shrink-0">
            <div class="rounded-full bg-blue-100 p-3 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Nombre total d'utilisateurs</p>
                <p class="text-2xl font-bold text-gray-800">{{ $totalUsers }}</p>
            </div>
        </div>
        <a href="{{ route('admin.export.pdf') }}"
            class="bg-blue-500 hover:bg-blue-600 transition-colors text-white px-4 py-2 rounded shadow-sm font-semibold whitespace-nowrap">
            📄 Exporter en PDF
        </a>
    </div>

</div>

<div class="p-6">


    <h1 class="text-2xl font-bold mb-4">👥 Gestion des Utilisateurs (Parents)</h1>

    <!-- ✅ Modal de Confirmation -->
    <div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300">
        <div id="modalContent" class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 transform scale-95 transition-transform duration-300">
            <h2 class="text-xl font-semibold mb-4 text-red-600"> Confirmation de la suppression ❗</h2>
            <p class="mb-6 text-gray-700">
                Êtes-vous sûr de vouloir supprimer cet utilisateur ? <br>
                Cette action est <strong>irréversible</strong> et ne peut pas être annulée.
            </p>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-end gap-4">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Annuler</button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Supprimer</button>

                </div>
            </form>
        </div>
    </div>

    <!-- ✅ Tableau -->
    <div class="overflow-x-auto bg-white rounded shadow p-4">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100 text-left text-sm">
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
                    <td class="px-4 py-2">
                        {{ $user->created_at ? $user->created_at->format('d/m/Y') : 'Date inconnue' }}
                    </td>

                    <td class="px-4 py-2">
                        @if($user->isOnline())
                        <span class="text-green-600 font-semibold">Actif</span>
                        @else
                        <span class="text-gray-500">Inactif</span>
                        @endif
                    </td>

                    <td class="px-4 py-2">
                        <a href="#details-user-{{ $user->id }}" class="text-blue-600 hover:underline mr-2">Voir</a>

                        <button onclick="openModal('modal-{{ $user->id }}')" class="text-green-600 hover:underline mr-2">Détails</button>

                        <button onclick="confirmDelete({{ $user->id }})" class="text-red-600 hover:underline">Supprimer</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>

    <!-- ✅ Liste détaillée -->
    <h2 class="text-2xl font-bold mb-6 mt-10">Liste des utilisateurs</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($users as $user)
        <div id="details-user-{{ $user->id }}"
            class="bg-white rounded-xl shadow p-6 text-center transition-all transform duration-300">
            <h3 class="text-lg font-semibold">{{ $user->name }}</h3>
            <span class="inline-block text-sm text-white bg-blue-500 px-2 py-1 rounded mt-1">
                {{ ucfirst($user->role ?? 'Utilisateur') }}
            </span>
            <div class="mt-4 text-sm text-gray-600">
                <p><strong>📍</strong> {{ $user->ville ?? 'Inconnu' }}</p>
                <p><strong>📧</strong> {{ $user->email }}</p>
                <p><strong>📞</strong> {{ $user->numero ?? 'Non spécifié' }}</p>
            </div>
        </div>
        @endforeach
    </div>
    @foreach ($users as $user)
    <div id="modal-{{ $user->id }}" tabindex="-1" class="hidden fixed z-50 inset-0 overflow-y-auto bg-black bg-opacity-60 flex justify-center items-start pt-16">
        <div class="relative mx-auto bg-white rounded-lg shadow-xl w-full max-w-md transform transition-all duration-300 ease-in-out">
            <!-- En-tête -->
            <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-gradient-to-r from-blue-50 to-white">
                <h3 class="text-lg font-bold text-gray-800">Profil de {{ $user->name }}</h3>
                <button type="button" onclick="closeUserModal('modal-{{ $user->id }}')" class="text-gray-500 hover:text-gray-800 hover:bg-gray-100 rounded-full p-1 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Contenu -->
            <div class="p-5 space-y-4">
                <!-- Photo de profil si disponible -->
                <div class="flex justify-center mb-4">
                    @if($user->photo)
                    <div class="relative">
                        <img src="{{ asset('storage/' . $user->photo) }}" alt="Photo de {{ $user->name }}" class="w-24 h-24 rounded-full object-cover border-4 border-blue-100 shadow-md">
                    </div>
                    @else
                    <div class="w-24 h-24 rounded-full bg-blue-100 flex items-center justify-center text-blue-500 text-2xl font-bold shadow-md">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    @endif
                </div>

                <!-- Informations utilisateur -->
                <div class="bg-gray-50 rounded-lg p-4 shadow-inner space-y-3">
                    <div class="grid grid-cols-3 gap-2 items-center">
                        <span class="text-gray-500 font-medium col-span-1">Nom</span>
                        <span class="col-span-2 font-semibold text-gray-800">{{ $user->name }}</span>
                    </div>

                    <div class="grid grid-cols-3 gap-2 items-center">
                        <span class="text-gray-500 font-medium col-span-1">Email</span>
                        <span class="col-span-2 text-gray-800">{{ $user->email }}</span>
                    </div>

                    <div class="grid grid-cols-3 gap-2 items-center">
                        <span class="text-gray-500 font-medium col-span-1">Numéro</span>
                        <span class="col-span-2 text-gray-700">{{ $user->numero ?? 'Non renseigné' }}</span>
                    </div>

                    <div class="grid grid-cols-3 gap-2 items-center">
                        <span class="text-gray-500 font-medium col-span-1">Adresse</span>
                        <div class="col-span-2 text-gray-700">
                            <p>{{ $user->rue ?? 'Rue non renseignée' }}</p>
                            <p>{{ $user->code_postal ?? '' }} {{ $user->ville ?? 'Ville non renseignée' }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-2 items-center">
                        <span class="text-gray-500 font-medium col-span-1">Inscrit le</span>
                        <span class="col-span-2 text-gray-700">{{ $user->created_at ? $user->created_at->format('d/m/Y') : 'Inconnue' }}</span>
                    </div>
                </div>
            </div>

            <!-- Pied de modal -->
            <div class="p-4 border-t border-gray-100 flex justify-end">
                <button onclick="closeUserModal('modal-{{ $user->id }}')" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-50 font-medium transition-colors duration-200">Fermer</button>
            </div>
        </div>
    </div>
    @endforeach



    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }





    function confirmDelete(userId) {
        const modal = document.getElementById('deleteModal');
        const modalContent = document.getElementById('modalContent');
        const form = document.getElementById('deleteForm');

        // Injecter l'action du formulaire
        form.action = `/admin/utilisateurs/${userId}`;

        // Afficher le modal
        modal.classList.remove('opacity-0', 'pointer-events-none');
        modalContent.classList.remove('scale-95');
        modalContent.classList.add('scale-100');
    }

    function closeModal() {
        const modal = document.getElementById('deleteModal');
        const modalContent = document.getElementById('modalContent');

        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');

        setTimeout(() => {
            modal.classList.add('opacity-0', 'pointer-events-none');
        }, 300);
    }

    // Fermer le modal si on clique en dehors
    document.getElementById('deleteModal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeModal();
        }
    });
    // Voir button scroll + hover animation
    document.querySelectorAll('a[href^="#details-user-"]').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const target = document.getElementById(targetId);

            if (target) {
                // Scroll to user card with delay to ensure smooth scroll
                setTimeout(() => {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });

                    // Add temporary animation style
                    target.classList.add('ring-4', 'ring-blue-400', 'scale-105', 'bg-gray-100');

                    // Remove animation after delay
                    setTimeout(() => {
                        target.classList.remove('ring-4', 'ring-blue-400', 'scale-105', 'bg-gray-100');
                    }, 2000);
                }, 200);
            }
        });
    });

    function closeUserModal(id) {
        document.getElementById(id).classList.add('hidden');
    }
</script>
@endpush