@extends('layouts.admin')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    <!-- Total messages -->
    <div class="bg-white p-4 rounded shadow">
        <p class="text-sm text-gray-500 font-medium">Nombre total de messages</p>
        <p class="text-2xl font-bold text-gray-800">{{ $totalMessages->count() }}</p>
    </div>

    <!-- Messages non lus -->
    <div class="bg-white p-4 rounded shadow">
        <p class="text-sm text-gray-500 font-medium">Messages non lus</p>
        <p class="text-2xl font-bold text-red-600">{{ $unreadMessages->count() }}</p>
    </div>

    <!-- Messages lus -->
    <div class="bg-white p-4 rounded shadow">
        <p class="text-sm text-gray-500 font-medium">Messages lus</p>
        <p class="text-2xl font-bold text-green-600">{{ $readMessages->count() }}</p>
    </div>
</div>

     <div>
        <h2 class="text-2xl font-semibold mb-4">📬 Tous les messages</h2>
        @include('admin.messages.table', ['messages' => $totalMessages])
    </div>

    <!-- ❌ Messages non lus -->
    <div>
        <h2 class="text-2xl font-semibold mb-4 text-yellow-600">📩 Messages non lus</h2>
        @include('admin.messages.table', ['messages' => $unreadMessages])
    </div>

    <!-- ✅ Messages lus -->
    <div>
        <h2 class="text-2xl font-semibold mb-4 text-green-600">✅ Messages lus</h2>
        @include('admin.messages.table', ['messages' => $readMessages])
    </div>


    <!-- <div class="max-w-7xl mx-auto">

        {{-- TABLE DES MESSAGES NON LUS --}}
        <div class="bg-white shadow-md rounded-lg p-6 mb-10">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4 flex items-center gap-2">📩 Messages non lus</h2>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm text-gray-700">
                    <thead class="bg-gray-100 text-left">
                        <tr>
                            <th class="p-3">Nom</th>
                            <th class="p-3">Prénom</th>
                            <th class="p-3">Email</th>
                            <th class="p-3">Téléphone</th>
                            <th class="p-3">Message</th>
                            <th class="p-3">Date</th>
                            <th class="p-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($unreadMessages as $msg)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3">{{ $msg->nom }}</td>
                                <td class="p-3">{{ $msg->prenom }}</td>
                                <td class="p-3">{{ $msg->email }}</td>
                                <td class="p-3">{{ $msg->telephone }}</td>
                                <td class="p-3">{{ Str::limit($msg->message, 30) }}</td>
                                <td class="p-3">{{ $msg->created_at->format('d/m/Y H:i') }}</td>
                                <td class="p-3 flex flex-wrap gap-2">
                                    <a href="{{ route('admin.messages.show', $msg->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs">Détails</a>
                                    
                                    <form action="{{ route('admin.messages.markAsRead', $msg->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs">Marquer comme lu</button>
                                    </form>

                                    <button onclick="confirmDelete({{ $msg->id }})"class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm shadow ml-3">Supprimer</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <br>

        {{-- TABLE DES MESSAGES LUS --}}
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4 flex items-center gap-2">📬 Messages lus</h2>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm text-gray-700">
                    <thead class="bg-gray-100 text-left">
                        <tr>
                            <th class="p-3">Nom</th>
                            <th class="p-3">Prénom</th>
                            <th class="p-3">Email</th>
                            <th class="p-3">Téléphone</th>
                            <th class="p-3">Message</th>
                            <th class="p-3">Date</th>
                            <th class="p-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($readMessages as $msg)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3">{{ $msg->nom }}</td>
                                <td class="p-3">{{ $msg->prenom }}</td>
                                <td class="p-3">{{ $msg->email }}</td>
                                <td class="p-3">{{ $msg->telephone }}</td>
                                <td class="p-3">{{ Str::limit($msg->message, 30) }}</td>
                                <td class="p-3">{{ $msg->created_at->format('d/m/Y H:i') }}</td>
                                <td class="p-3 flex flex-wrap gap-2">
                                    <a href="{{ route('admin.messages.show', $msg->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs">Détails</a>

                            <button onclick="confirmDelete({{ $msg->id }})"class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm shadow ml-3"> Supprimer</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> -->

    </div>
</div>

<!-- Modal de confirmation -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div id="modalContent" class="bg-white rounded-lg shadow-lg p-6 w-full max-w-sm transform transition duration-200 scale-95">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Confirmer la suppression</h3>
        <p class="text-gray-600 mb-6">Es-tu sûr de vouloir supprimer ce message ? Cette action est irréversible.</p>
        <div class="flex justify-end space-x-3">
            <button onclick="closeModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded text-sm">
                Annuler
            </button>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm">
                    Supprimer
                </button>
            </form>
        </div>
    </div>
</div>
<script>
    function confirmDelete(id) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        const modalContent = document.getElementById('modalContent');

        // Définir l'URL dynamiquement
        form.action = `/admin/messages/${id}`;

        modal.classList.remove('hidden');
        setTimeout(() => {
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
        }, 10);
    }

    function closeModal() {
        const modal = document.getElementById('deleteModal');
        const modalContent = document.getElementById('modalContent');

        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 150);
    }
</script>

@endsection
