@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">📚 Ressources</h1>

    <div class="mb-4">
        <p>Nombre total de ressources publiées : <strong>{{ $ressources->count() }}</strong></p>
       
    </div>
     <div class="mb-3">
       
        <a href="{{ route('admin.ressources.create') }}" class="bg-blue-500 text-white px-4 py-2  rounded">➕ Ajouter un article/vidéo</a>
    </div>

    <table class="w-full table-auto bg-white rounded shadow">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2">Titre</th>
                <th>Catégorie</th>
                <th> Description</th>
                <th class="p-2">Visibilité</th>
                <th class="p-2">ordre </th>
                <th class="p-2"> image </th>
                <th>Vidéo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ressources as $res)
                <tr class="border-b">
                    <td class="p-2">{{ $res->titre }}</td>
                    <td>{{ $res->categorie }}</td>
                     <td>{{ $res->description }}</td>
                    <td>{{ $res->visibilite }}</td>
                  
                  <td>{{ $res->ordre }}</td>
                   <td><a href="{{ $res->preview_image }}" target="_blank" class="text-blue-600">Voir</a></td>
                    <td><a href="{{ $res->video_url }}" target="_blank" class="text-blue-600">Voir</a></td>
                    <td>
                        <a href="{{ route('admin.ressources.edit', $res) }}" class="text-yellow-500 mr-2">Modifier</a>
                        <button onclick="confirmDelete({{ $res->id }})" class="text-red-600 hover:underline">Supprimer</button>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- Modal de suppression -->
<div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 pointer-events-none transition-opacity duration-300 z-50">
    <div id="modalContent" class="bg-white rounded-lg p-6 transform transition-transform scale-95 w-full max-w-md shadow-lg">
        <h2 class="text-lg font-semibold mb-4">Confirmer la suppression</h2>
        <p class="mb-6 text-gray-600">Voulez-vous vraiment supprimer cette ressource ? Cette action est irréversible.</p>
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Annuler</button>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Supprimer</button>
            </div>
        </form>
    </div>
</div>
<script>
    function confirmDelete(resId) {
        const modal = document.getElementById('deleteModal');
        const modalContent = document.getElementById('modalContent');
        const form = document.getElementById('deleteForm');

        // Mise à jour de l'action du formulaire
        form.action = `/admin/ressources/${resId}`;

        // Affiche le modal
        modal.classList.remove('opacity-0', 'pointer-events-none');
        modalContent.classList.remove('scale-95');
        modalContent.classList.add('scale-100');
    }

    function closeModal() {
        const modal = document.getElementById('deleteModal');
        const modalContent = document.getElementById('modalContent');

        // Cache le modal
        modal.classList.add('opacity-0', 'pointer-events-none');
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
    }
</script>

@endsection
