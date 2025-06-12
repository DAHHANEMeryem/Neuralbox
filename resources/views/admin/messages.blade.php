@extends('layouts.admin')

@section('title', 'messages')
@section('page-title', 'messages')

@section('content')
<link href="{{ asset('css/messages.css') }}" rel="stylesheet">

<div class="container">
    <div class="header">
        <h1>Tableau de Bord - Messages Utilisateurs</h1>
    </div>

    <div class="filter-section">
        <div class="filter-item">
            <label for="date-filter">Date:</label>
            <input type="date" id="date-filter" />
        </div>
        <div class="filter-item">
            <label for="name-filter">Nom:</label>
            <input type="text" id="name-filter" placeholder="Filtrer par nom" />
        </div>
        <div class="filter-item">
            <label>
                <input type="checkbox" id="show-read" />
                عرض الرسائل المقروءة
            </label>
        </div>
    </div>

    <table class="user-messages-table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Message</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="messages-table-body">
            @foreach($messages as $message)
                <tr class="main-row {{ $message->is_read ? 'read' : '' }}">
                    <td>{{ $message->nom }}</td>
                    <td>{{ $message->prenom }}</td>
                    <td>{{ $message->email }}</td>
                    <td>{{ $message->telephone }}</td>
                    <td class="short-message">{{ \Illuminate\Support\Str::limit($message->message, 30, '...') }}</td>
                    <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
                    <td class="action-buttons">
                        <button class="btn btn-view">
                            <i class="fas fa-eye"></i> Voir
                        </button>
                        <form method="POST" action="{{ route('admin.messages.destroy', $message->id) }}" class="delete-form" data-message-id="{{ $message->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-delete open-delete-modal">
                                <i class="fas fa-trash"></i> Supprimer
                            </button>
                            <div id="message-{{ $message->id }}" class="flex items-center justify-between p-2 bg-gray-100 rounded shadow w-full max-w-sm">
                                <p class="text-sm text-gray-800">{{ $message->content }}</p>
                                @if (!$message->is_read)
                                  <button onclick="markAsRead({{ $message->id }})" class="text-blue-600 text-sm hover:underline">
                                    Mark as Read
                                  </button>
                                @else
                                  <span class="text-green-600 text-sm font-semibold">✔️ Vu</span>
                                @endif
                              </div>
                              
                        </form>
                    </td>
                </tr>
                <tr class="full-message-row" style="display: none;">
                    <td colspan="7" style="background-color: #f9f9f9; padding: 1rem;">
                        <strong>Message complet :</strong><br>
                        {{ $message->message }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- ✅ MODAL DE CONFIRMATION -->
<div id="delete-confirm-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-96 shadow-xl">
        <h2 class="text-lg font-bold text-red-600 mb-2">Confirmation de suppression</h2>
        <p class="text-sm text-gray-700 mb-6">Êtes-vous sûr de vouloir supprimer ce message ? Cette action est irréversible.</p>
        <div class="flex justify-end gap-4">
            <button id="cancel-delete" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Annuler</button>
            <button id="confirm-delete" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Oui, supprimer</button>
        </div>
    </div>
</div>

<!-- ✅ SCRIPT -->
<script>
    // Voir le message complet
    document.querySelectorAll('.btn-view').forEach((btn) => {
        btn.addEventListener('click', () => {
            const mainRow = btn.closest('tr');
            const nextRow = mainRow.nextElementSibling;
            const isVisible = nextRow.style.display === 'table-row';
            nextRow.style.display = isVisible ? 'none' : 'table-row';
            btn.innerHTML = isVisible ? '<i class="fas fa-eye"></i> Voir' : '<i class="fas fa-eye-slash"></i> Masquer';
        });
    });

    // Modal de suppression
    let deleteForm = null;
    document.querySelectorAll('.open-delete-modal').forEach(btn => {
        btn.addEventListener('click', function () {
            deleteForm = this.closest('form');
            document.getElementById('delete-confirm-modal').classList.remove('hidden');
            document.getElementById('delete-confirm-modal').classList.add('flex');
        });
    });

    document.getElementById('cancel-delete').addEventListener('click', function () {
        document.getElementById('delete-confirm-modal').classList.add('hidden');
        document.getElementById('delete-confirm-modal').classList.remove('flex');
        deleteForm = null;
    });

    document.getElementById('confirm-delete').addEventListener('click', function () {
        if (deleteForm) {
            deleteForm.submit();
        }
    });

    // Filtrage
    document.getElementById('name-filter').addEventListener('input', filterMessages);
    document.getElementById('date-filter').addEventListener('input', filterMessages);
    document.getElementById('show-read').addEventListener('change', filterMessages);

    function filterMessages() {
        const nameFilter = document.getElementById('name-filter').value.toLowerCase();
        const dateFilter = document.getElementById('date-filter').value;
        const showRead = document.getElementById('show-read').checked;

        const rows = document.querySelectorAll('.main-row');

        rows.forEach(row => {
            const fullRow = row.nextElementSibling;
            const name = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
            const date = row.querySelector('td:nth-child(6)').textContent;
            const normalizedDate = date.split(' ')[0].split('/').reverse().join('-');
            const isRead = row.classList.contains('read');

            const matchesName = name.startsWith(nameFilter);
            const matchesDate = !dateFilter || normalizedDate === dateFilter;
            const matchesRead = showRead || !isRead;

            const shouldShow = matchesName && matchesDate && matchesRead;

            row.style.display = shouldShow ? '' : 'none';
            if (fullRow && fullRow.classList.contains('full-message-row')) {
                fullRow.style.display = 'none';
            }
        });
    }
</script>
@endsection
