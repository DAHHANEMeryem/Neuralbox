@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">✏️ Modifier la ressource</h1>

    @if ($errors->any())
        <div class="mb-4 text-red-600">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.ressources.update', $ressource->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="titre" class="block font-semibold">Titre</label>
            <input type="text" name="titre" id="titre" value="{{ $ressource->titre }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block font-semibold">Description</label>
            <textarea name="description" id="description" rows="3" class="w-full border rounded px-3 py-2">{{ $ressource->description }}</textarea>
        </div>

        <div class="mb-4">
            <label for="video_url" class="block font-semibold">URL de la vidéo</label>
            <input type="url" name="video_url" id="video_url" value="{{ $ressource->video_url }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label for="categorie" class="block font-semibold">Catégorie</label>
            <select name="categorie" id="categorie" class="w-full border rounded px-3 py-2" required>
                <option value="pedagogie" {{ $ressource->categorie == 'pedagogie' ? 'selected' : '' }}>Pédagogie</option>
                <option value="محتوى نيورال بوكس" {{ $ressource->categorie == 'محتوى نيورال بوكس' ? 'selected' : '' }}>محتوى نيورال بوكس</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="visibilite" class="block font-semibold">Visibilité</label>
            <select name="visibilite" id="visibilite" class="w-full border rounded px-3 py-2" required>
                <option value="tous" {{ $ressource->visibilite == 'tous' ? 'selected' : '' }}>Tout le monde</option>
                <option value="abonne" {{ $ressource->visibilite == 'abonne' ? 'selected' : '' }}>Abonnés uniquement</option>
            </select>
        </div>
        <div class="mb-4">
    <label for="ordre" class="block font-semibold">Ordre d'affichage</label>
    <input type="number" name="ordre" id="ordre" value="{{ $ressource->ordre }}" class="w-full border rounded px-3 py-2">
</div>

<div class="mb-4">
    <label for="preview_image" class="block font-semibold">Image de prévisualisation</label>
    
    @if ($ressource->preview_image)
        <div class="mb-2">
            <img src="{{ asset('storage/' . $ressource->preview_image) }}" alt="Image actuelle" class="w-40 rounded shadow">
        </div>
    @endif
    
    <input type="file" name="preview_image" id="preview_image" class="w-full border rounded px-3 py-2">
</div>


        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
            Enregistrer les modifications
        </button>
    </form>
</div>
@endsection
