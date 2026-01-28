@extends('layouts.admin')

@section('content')


<div class="md:p-6 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-extrabold mb-6 text-indigo-700 flex items-center gap-2">Avis</h1>


    <div class="md:p-5 mb-2">
        <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-blue-500 flex items-center transition-all duration-300 hover:shadow-lg hover:translate-y-[-2px]">
            <div class="rounded-full bg-blue-100 p-2 mr-4 flex-shrink-0">
                <i class="fas fa-book w-5 text-center"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Nombre total des avis sur ce video</p>
                <p class="text-2xl font-bold text-gray-800">{{ $reviews->count() }}</p>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto rounded-lg shadow-lg bg-white">
        <table class="w-full table-auto border-collapse">
            <thead class="bg-gray-100 text-gray-600 md:font-semibold uppercase text-xs">
                <tr>
                    <th class="p-3 text-left">Utilisateur</th>
                    <th class="p-3 text-left">Titre de video</th>
                    <th class="p-3 text-left">Voir avis</th>
                    {{-- <th class="p-3 text-left">Télécharger avis</th> --}}
                    {{-- <th class="p-3 text-left">Avis</th>
                    <th class="p-3 text-center">Visibilité</th>
                    <th class="p-3 text-center">Ordre</th>
                    <th class="p-3 text-center">Image</th>
                    <th class="p-3 text-center">Vidéo</th>
                    <th class="p-3 text-center">Actions</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $res)
                <tr class="border-b hover:bg-indigo-50 transition text-sm">
                    <td class="p-3">{{ $res->user->name }}</td>
                    <td class="p-3">{{ $res->ressource->titre }}</td>
                    <td class="p-3"><a href="{{route('ressource.reviews.show',['id'=> $res->id])}}"><i class="fa fa-eye text-slate-700"></i></a></td>
                    {{-- <td class="p-3"><a href="{{route('ressource.reviews',['id'=> $res->id])}}">Télécharger avis</a></td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
{{-- 
<!-- Modal de suppression -->
<div id="deleteModal"
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 pointer-events-none transition-opacity duration-300 z-50">
    <div id="modalContent"
        class="bg-white rounded-xl p-6 max-w-md w-full shadow-lg transform scale-95 transition-transform duration-200">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Confirmer la suppression</h2>
        <p class="mb-6 text-gray-600">Voulez-vous vraiment supprimer cette ressource ? Cette action est irréversible.</p>
        <form id="deleteForm" method="POST" class="flex justify-end gap-4">
            @csrf
            @method('DELETE')
            <button type="button"
                onclick="closeModal()"
                class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition font-medium">
                Annuler
            </button>
            <button type="submit"
                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition font-semibold">
                Supprimer
            </button>
        </form>
    </div>
</div>

<script>
    function confirmDelete(resId) {
        const modal = document.getElementById('deleteModal');
        const modalContent = document.getElementById('modalContent');
        const form = document.getElementById('deleteForm');

        form.action = `/admin/ressources/${resId}`;

        modal.classList.remove('opacity-0', 'pointer-events-none');
        modalContent.classList.remove('scale-95');
        modalContent.classList.add('scale-100');
    }

    function closeModal() {
        const modal = document.getElementById('deleteModal');
        const modalContent = document.getElementById('modalContent');

        modal.classList.add('opacity-0', 'pointer-events-none');
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
    }
</script> --}}
@endsection