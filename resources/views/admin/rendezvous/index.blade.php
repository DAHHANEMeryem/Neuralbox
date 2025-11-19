@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">📆 Tous les Rendez-vous</h2>

    <div class="mb-4 grid grid-cols-2 md:grid-cols-5 gap-4">
        <div class="bg-blue-100 p-4 rounded shadow">
            <p class="text-sm text-gray-700">Total Aujourd'hui</p>
            <p class="text-2xl font-semibold text-blue-800">{{ $totalToday }}</p>
        </div>
        <div class="bg-amber-100 p-4 rounded shadow">
            <p class="text-sm text-gray-700">Total Cette Semaine</p>
            <p class="text-2xl font-semibold text-amber-800">{{ $totalWeek }}</p>
        </div>
        <div class="bg-green-100 p-4 rounded shadow">
            <p class="text-sm text-gray-700">Total Ce Mois</p>
            <p class="text-2xl font-semibold text-green-800">{{ $totalmonth }}</p>
        </div>
        <div class="bg-yellow-100 p-4 rounded shadow">
            <p class="text-sm text-gray-700">En Attente</p>
            <p class="text-2xl font-semibold text-yellow-800">{{ $totalAttente }}</p>
        </div>
        <div class="bg-gray-100 p-4 rounded shadow">
            <p class="text-sm text-gray-700">Total Rendez-vous</p>
            <p class="text-2xl font-semibold text-gray-800">{{ $totalRdv }}</p>
        </div>
    </div>

    <div class="mb-6">
        <form method="GET" action="{{ route('admin.rendezvous.index') }}" class="flex flex-wrap gap-4 items-end">
            <div>
                <label for="statut" class="block font-medium mb-1">Filtrer par statut :</label>
                <select name="statut" onchange="this.form.submit()" class="border rounded p-2">
                    <option value="">Tous</option>
                    <option value="attente" {{ request('statut') == 'attente' ? 'selected' : '' }}>En attente</option>
                    <option value="confirme" {{ request('statut') == 'confirme' ? 'selected' : '' }}>Confirmés</option>

                    <option value="annule" {{ request('statut') == 'annule' ? 'selected' : '' }}>Annulés</option>
                </select>
            </div>

            <div>
                <label for="search" class="block font-medium mb-1">Recherche par nom :</label>
                <input type="text" name="search" id="namerecherche" value="{{ request('search') }}" placeholder="Tapez un nom..." class="border rounded form-control p-2">
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Rechercher</button>
                <a href="{{ route('admin.rendezvous.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded ml-2">Réinitialiser</a>
            </div>
        </form>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
        <p>{{ session('success') }}</p>
    </div>
    @endif

    <div class="mt-6">
        <h2 class="text-xl font-bold mb-4">📋 Liste des rendez-vous</h2>
        <div class="overflow-x-auto bg-white shadow rounded">
            <table class="w-full text-left table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3">#</th>
                        <th class="p-3">Nom</th>
                        <th class="p-3">Email</th>
                        <th class="p-3">Téléphone</th>
                        <th class="p-3">Date</th>
                        <th class="p-3">Statut</th>

                        <th class="p-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rendezvous as $rdv)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $rdv->id }}</td>
                        <td class="p-3">{{ $rdv->user->name ?? $rdv->nom }}</td>
                        <td class="p-3">{{ $rdv->email }}</td>
                        <td class="p-3">{{ $rdv->numero }}</td>
                        <td class="p-3">{{ \Carbon\Carbon::parse($rdv->date)->format('d/m/Y H:i') }}</td>
                        <td class="p-3">
                            @php
                            $colors = [
                            'attente' => 'bg-yellow-100 text-yellow-800',
                            'confirme' => 'bg-green-100 text-green-800',
                            'annule' => 'bg-red-100 text-red-800',
                            'refuse' => 'bg-gray-100 text-gray-800'
                            ];
                            @endphp
                            <span class="px-2 py-1 rounded {{ $colors[$rdv->statut] ?? '' }}">
                                {{ ucfirst($rdv->statut) }}
                            </span>
                        </td>

                        <td class="p-3">
                            <div class="flex space-x-2">
                                @if($rdv->statut == 'attente')
                                <form action="{{ route('admin.rendezvous.updateStatus', $rdv->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="statut" value="confirme">
                                    <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded text-xs" onclick="return confirm('Confirmer ce rendez-vous?')">
                                        Accepter
                                    </button>
                                </form>
                                <form action="{{ route('admin.rendezvous.updateStatus', $rdv->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="statut" value="refuse">
                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded text-xs" onclick="return confirm('Refuser ce rendez-vous?')">
                                        Refuser
                                    </button>
                                </form>
                                @endif
                                <button type="button" class="bg-blue-500 text-white px-2 py-1 rounded text-xs" onclick="showDetails({{ $rdv->id }})">
                                    Détails
                                </button>

                                <a href="{{ route('rendezvous.edit', $rdv->id) }}" class="bg-purple-500 text-white px-2 py-1 rounded text-xs">
                                    Modifier
                                </a>

                                <button onclick="confirmDelete({{ $rdv->id }})" class="bg-red-500 text-white px-2 py-1 rounded text-xs">
                                    Supprimer
                                </button>

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="p-4 text-center text-gray-500">Aucun rendez-vous trouvé.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


    <div class="mt-4">
        {{ $rendezvous->withQueryString()->links() }}
    </div>

</div>
<!-- Fenêtre modale de confirmation -->
<div id="deleteModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition duration-200 z-50">
    <div id="modalContentt" class="bg-white p-6 rounded shadow-md transform scale-95 transition duration-200 w-full max-w-md">
        <h2 class="text-lg font-semibold mb-4 text-gray-800">Confirmer la suppression</h2>
        <p class="mb-6 text-gray-600">Êtes-vous sûr de vouloir supprimer ce rendez-vous ? Cette action est irréversible.</p>

        <form id="deleteForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <div class="flex justify-end gap-4">
                <button type="button" onclick="closeeModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                    Annuler
                </button>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    Supprimer
                </button>
            </div>
        </form>
    </div>
</div>

<div id="detailsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-2xl w-full mx-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold">Détails du rendez-vous</h3>
            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div id="modalContent" class="space-y-4">
            <!-- Le contenu sera chargé dynamiquement -->
        </div>
        <div class="mt-6 flex justify-end">
            <button onclick="closeModal()" class="bg-gray-300 text-gray-700 px-4 py-2 rounded">Fermer</button>
        </div>
    </div>
</div>


<script>
    function confirmDelete(rdvId) {
        const modal = document.getElementById('deleteModal');
        const modalContentt = document.getElementById('modalContentt');
        const form = document.getElementById('deleteForm');

        // Modifier l'action dynamiquement
        form.action = `/admin/rendezvous/${rdvId}`;

        // Afficher le modal
        modal.classList.remove('opacity-0', 'pointer-events-none');
        modalContentt.classList.remove('scale-95');
        modalContentt.classList.add('scale-100');
    }

    function closeeModal() {
        const modal = document.getElementById('deleteModal');
        const modalContentt = document.getElementById('modalContentt');

        // Masquer le modal
        modal.classList.add('opacity-0', 'pointer-events-none');
        modalContentt.classList.remove('scale-100');
        modalContentt.classList.add('scale-95');
    }
    document.getElementById('namerecherch').addEventListener('input', filterMessages);
    document.getElementById('date-filter').addEventListener('input', filterMessages);

    function filterMessages() {
        const namerecherch = document.getElementById('namerecherch').value.toLowerCase();
        const dateFilter = document.getElementById('date-filter').value; // Format: yyyy-mm-dd

        const rows = document.querySelectorAll('.main-row');

        rows.forEach(row => {
            const fullRow = row.nextElementSibling;
            const name = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
            const date = row.querySelector('td:nth-child(6)').textContent; // format: dd/mm/yyyy HH:mm

            const normalizedDate = date.split(' ')[0].split('/').reverse().join('-');

            const matchesName = name.startsWith(namerecherch);
            const matchesDate = !dateFilter || normalizedDate === dateFilter;

            const shouldShow = matchesName && matchesDate;

            row.style.display = shouldShow ? '' : 'none';
            if (fullRow && fullRow.classList.contains('full-message-row')) {
                fullRow.style.display = 'none'; // always hide unless view clicked
            }
        });
    }

    function showDetails(id) {
        // Ici vous devriez charger les détails du rendez-vous via AJAX
        // Pour l'exemple, je vais simuler un contenu
        fetch(`/admin/rendezvous/${id}/details`)
            .then(response => response.json())
            .then(data => {
                const modalContent = document.getElementById('modalContent');

                // Construire le contenu HTML avec les données
                let html = `
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="font-semibold">Nom:</p>
                            <p>${data.nom || data.user?.name || '-'}</p>
                        </div>
                        <div>
                            <p class="font-semibold">Email:</p>
                            <p>${data.email}</p>
                        </div>
                        <div>
                            <p class="font-semibold">Téléphone:</p>
                            <p>${data.numero}</p>
                        </div>
                        <div>
                            <p class="font-semibold">Date:</p>
                            <p>${data.date_formatted}</p>
                        </div>
                        <div class="col-span-2">
                            <p class="font-semibold">Statut:</p>
                            <p>${data.statut_formatted}</p>
                        </div>
                        <div class="col-span-2">
                            <p class="font-semibold">Message:</p>
                            <p>${data.message}</p>
                        </div>
                        <div class="col-span-2">
                            <p class="font-semibold">Créé le:</p>
                            <p>${data.created_at_formatted}</p>
                        </div>
                    </div>
                `;

                if (data.statut === 'attente') {
                    html += `
                        <div class="mt-4 flex space-x-4">
                            <form action="/admin/rendezvous/${id}/update-status" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="statut" value="confirme">
                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                                    Accepter
                                </button>
                            </form>
                            <form action="/admin/rendezvous/${id}/update-status" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="statut" value="refuse">
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">
                                    Refuser
                                </button>
                            </form>
                        </div>
                    `;
                }

                modalContent.innerHTML = html;
                document.getElementById('detailsModal').classList.remove('hidden');
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Erreur lors du chargement des détails');
            });
    }

    function closeModal() {
        document.getElementById('detailsModal').classList.add('hidden');
    }

    // Fermer la modal si on clique en dehors
    window.onclick = function(event) {
        const modal = document.getElementById('detailsModal');
        if (event.target === modal) {
            closeModal();
        }
    }
</script>
@endsection