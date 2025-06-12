@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">➕ Ajouter une ressource</h1>

    @if ($errors->any())
        <div class="mb-4 text-red-600">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.ressources.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="titre" class="block font-semibold">Titre</label>
            <input type="text" name="titre" id="titre" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block font-semibold">Description</label>
            <textarea name="description" id="description" rows="3" class="w-full border rounded px-3 py-2"></textarea>
        </div>

       <div class="mb-4">
    <label for="video_url" class="block font-semibold mb-1">URL de la vidéo</label>

    <input type="url" name="video_url" id="video_url" class="w-full border rounded px-3 py-2 mb-2" required placeholder="Collez une URL ou choisissez dans Google Drive">

    <button type="button" id="btn-google-drive" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Choisir depuis Google Drive
    </button>
</div>
<div class="mb-4">
    <label for="preview_image" class="block font-semibold">Image de prévisualisation</label>
    <input type="file" name="preview_image" id="preview_image" accept="image/*" class="w-full border rounded px-3 py-2">
</div>

<div class="mb-4">
    <label for="ordre" class="block font-semibold">Ordre d'affichage</label>
    <input type="number" name="ordre" id="ordre" class="w-full border rounded px-3 py-2" value="0" min="0">
</div>


        <div class="mb-4">
            <label for="categorie" class="block font-semibold">Catégorie</label>
            <select name="categorie" id="categorie" class="w-full border rounded px-3 py-2" required>
                <option value="pedagogie">Pédagogie</option>
                <option value="neuralbox">محتوى نيورال بوكس</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="visibilite" class="block font-semibold">Visibilité</label>
            <select name="visibilite" id="visibilite" class="w-full border rounded px-3 py-2" required>
                <option value="tous">Tout le monde</option>
                <option value="abonne">Abonnés uniquement</option>
            </select>
        </div>


        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Ajouter la ressource
        </button>
    </form>
</div>

@endsection
