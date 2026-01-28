@extends('layouts.admin')

@section('content')
<div class="md:p-6 space-y-2 bg-gray-50 min-h-screen">
    <h1 class="text-lg md:text-3xl font-extrabold md:mb-6 text-indigo-700 flex items-center gap-2">📚 Ressources</h1>


    <div class="md:p-5">
        <div class="bg-white rounded-lg shadow-md p-2 md:p-4 border-l-4 border-blue-500 flex items-center transition-all duration-300 hover:shadow-lg hover:translate-y-[-2px]">
            <div class="rounded-full bg-blue-100 p-2 mr-4 flex-shrink-0">
                <i class="fas fa-book w-5 text-center"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Nombre total de ressources publiées</p>
                <p class="text-2xl font-bold text-gray-800">{{ $ressources->count() }}</p>
            </div>
        </div>
    </div>

    <div class="mb-6">
        <a href="{{ route('admin.ressources.create') }}"
            class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-semibold transition">
            ➕ Ajouter un article/vidéo
        </a>
    </div>

    <div class="overflow-x-auto rounded-lg shadow-lg bg-white">
        <table class="w-full table-auto border-collapse">
            <thead class="bg-gray-100 text-gray-600 font-semibold uppercase text-xs md:text-sm">
                <tr>
                    <th class="p-1 md:p-3 text-left">Titre</th>
                    <th class="p-1 md:p-3 text-left">Type</th>
                    <th class="p-1 md:p-3 text-left">Catégorie</th>
                    <th class="p-1 md:p-3 text-left">Description</th>
                    <th class="p-1 md:p-3 text-left">Avis</th>
                    <th class="p-1 md:p-3 text-center">Visibilité</th>
                    <th class="p-1 md:p-3 text-center">Ordre</th>
                    <th class="p-1 md:p-3 text-center">Image</th>
                    <th class="p-1 md:p-3 text-center">Vidéo</th>
                    <th class="p-1 md:p-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ressources as $res)
                <tr class="border-b hover:bg-indigo-50 transition">
                    <td class="p-1 text-sm md:p-3">{{ $res->titre }}</td>
                    <td class="p-1 text-sm md:p-3">{{ $res->categorie }}</td>
                    <td class="p-1 text-sm md:p-3">{{ $res->category ? $res->category->name : __('transelt.sans') }}</td>
                    <td class="p-1 text-sm md:p-3">{{ Str::limit($res->description, 50) }}</td>
                    <td class="p-1 text-sm md:p-3 text-green-500"><a href="{{route('ressource.reviews',['id'=> $res->id])}}">Voir avis</a></td>
                    <td class="p-1 text-sm md:p-3 text-center">{{ ucfirst($res->visibilite) }}</td>
                    <td class="p-1 text-sm md:p-3 text-center">{{ $res->ordre }}</td>
                    <td class="p-1 text-sm md:p-3 text-center">
                        @if($res->preview_image)
                        <a href="{{ asset('/' . $res->preview_image) }}" target="_blank" class="text-blue-600 hover:underline">Voir</a>
                        @else
                        <span class="text-gray-400">N/A</span>
                        @endif
                    </td>
                    <td class="p-1 text-sm md:p-3 text-center">
                        @if($res->video_url)
                        <a href="{{ asset('storage/' . $res->video_url) }}" target="_blank" class="text-blue-600 hover:underline">Voir</a>
                        @else
                        <span class="text-gray-400">N/A</span>
                        @endif
                    </td>
                    <td class="p-1 text-sm md:p-3 text-center whitespace-nowrap">
                        <a href="{{ route('admin.ressources.edit', $res) }}"
                            class="text-yellow-500 hover:text-yellow-600 font-semibold mr-4 transition">
                            <i class="fa fa-pen"></i>
                        </a>
                        <button onclick="confirmDelete({{ $res->id }})"
                            class="text-red-600 hover:underline font-semibold cursor-pointer transition">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
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
</script>
@endsection