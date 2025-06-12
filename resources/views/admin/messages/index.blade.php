@extends('layouts.admin')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
        <!-- Total messages -->
        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200">
            <p class="text-sm text-gray-500 font-medium uppercase tracking-wide">Nombre total de messages</p>
            <p class="text-3xl font-extrabold text-gray-800 mt-2">{{ $totalMessages->count() }}</p>
        </div>

        <!-- Messages non lus -->
        <div class="bg-white p-6 rounded-xl shadow-md border border-red-200">
            <p class="text-sm text-red-600 font-semibold uppercase tracking-wide">Messages non lus</p>
            <p class="text-3xl font-extrabold text-red-600 mt-2">{{ $unreadMessages->count() }}</p>
        </div>

        <!-- Messages lus -->
        <div class="bg-white p-6 rounded-xl shadow-md border border-green-200">
            <p class="text-sm text-green-600 font-semibold uppercase tracking-wide">Messages lus</p>
            <p class="text-3xl font-extrabold text-green-600 mt-2">{{ $readMessages->count() }}</p>
        </div>
    </div>

    <!-- Tous les messages -->
    <div class="bg-white p-6 rounded-xl shadow-md mb-8 border border-gray-200">
        <h2 class="text-2xl font-bold text-indigo-700 mb-6 flex items-center gap-2">📬 Tous les messages</h2>
        @include('admin.messages.table', ['messages' => $totalMessages])
    </div>

    <!-- Messages non lus -->
    <div class="bg-white p-6 rounded-xl shadow-md mb-8 border border-yellow-300">
        <h2 class="text-2xl font-bold text-yellow-600 mb-6 flex items-center gap-2">📩 Messages non lus</h2>
        @include('admin.messages.table', ['messages' => $unreadMessages])
    </div>

    <!-- Messages lus -->
    <div class="bg-white p-6 rounded-xl shadow-md border border-green-300">
        <h2 class="text-2xl font-bold text-green-600 mb-6 flex items-center gap-2">✅ Messages lus</h2>
        @include('admin.messages.table', ['messages' => $readMessages])
    </div>
</div>

<!-- Modal de confirmation -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div id="modalContent" 
         class="bg-white rounded-xl shadow-lg p-8 max-w-sm w-full transform scale-95 transition-transform duration-200">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Confirmer la suppression</h3>
        <p class="text-gray-600 mb-8">Es-tu sûr de vouloir supprimer ce message ? Cette action est irréversible.</p>
        <div class="flex justify-end gap-4">
            <button onclick="closeModal()" 
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-5 py-2 rounded-lg font-medium transition">
                Annuler
            </button>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg font-semibold transition">
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
