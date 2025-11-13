@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- En-tête de la page -->
        <div class="mb-8">
            <nav class="flex items-center space-x-2 text-sm text-gray-500 mb-4">
                <a href="{{ route('admin.ressources.index') }}" class="hover:text-gray-700 transition-colors">
                    Ressources
                </a>
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                <span class="text-gray-900 font-medium">Modifier la ressource</span>
            </nav>

            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Modifier la ressource</h1>
                    <p class="mt-2 text-gray-600">Modifiez les informations de votre ressource pédagogique</p>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.ressources.index') }}"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Retour
                    </a>
                </div>
            </div>
        </div>

        <!-- Messages d'erreur -->
        @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
            <div class="flex items-center mb-2">
                <svg class="w-5 h-5 text-red-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                <h3 class="text-sm font-medium text-red-800">Erreurs de validation</h3>
            </div>
            <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Formulaire principal -->
        <form id="referenceEditForm" action="{{ route('admin.ressources.update', $ressource->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Informations générales -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Informations générales
                    </h2>
                </div>
                <div class="p-6 space-y-6">
                    <!-- Titre -->
                    <div>
                        <label for="titre" class="block text-sm font-medium text-gray-700 mb-2">
                            Titre de la ressource <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                            id="titre"
                            name="titre"
                            value="{{ old('titre', $ressource->titre) }}"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-sm"
                            placeholder="Entrez le titre de la ressource...">
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Description
                        </label>
                        <textarea id="description"
                            name="description"
                            rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-sm resize-none"
                            placeholder="Décrivez brièvement cette ressource...">{{ old('description', $ressource->description) }}</textarea>
                    </div>

                    <!-- Ligne avec catégorie et visibilité -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Catégorie -->
                        <div>
                            <label for="categorie" class="block text-sm font-medium text-gray-700 mb-2">
                                Catégorie <span class="text-red-500">*</span>
                            </label>
                            <select id="categorie"
                                name="categorie"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-sm">
                                <option value="pedagogie" {{ $ressource->categorie == 'pedagogie' ? 'selected' : '' }}>
                                    📚 Pédagogie
                                </option>
                                <option value="neuralbox" {{ $ressource->categorie == 'neuralbox' ? 'selected' : '' }}>
                                    🧠 محتوى نيورال بوكس
                                </option>
                            </select>
                        </div>

                        <!-- Visibilité -->
                        <div>
                            <label for="visibilite" class="block text-sm font-medium text-gray-700 mb-2">
                                Visibilité <span class="text-red-500">*</span>
                            </label>
                            <select id="visibilite"
                                name="visibilite"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-sm">
                                <option value="tous" {{ $ressource->visibilite == 'tous' ? 'selected' : '' }}>
                                    🌍 Tout le monde
                                </option>
                                <option value="abonne" {{ $ressource->visibilite == 'abonne' ? 'selected' : '' }}>
                                    👤 Abonnés uniquement
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="flex gap-2 justify-between">
                        <!-- Ordre d'affichage -->
                        <div class="w-full">
                            <label for="ordre" class="block text-sm font-medium text-gray-700 mb-2">
                                Ordre d'affichage
                            </label>
                            <input type="number"
                                id="ordre"
                                name="ordre"
                                value="{{ old('ordre', $ressource->ordre) }}"
                                min="0"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-sm"
                                placeholder="0">
                            <p class="mt-1 text-xs text-gray-500">Plus le nombre est petit, plus la ressource apparaîtra en premier</p>
                        </div>
                        <div class="w-full">
                            <label for="ordre" class="block text-sm font-medium text-gray-700 mb-2">
                                Categorie du video
                            </label>
                            <select id="category"
                                name="category"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-sm">
                                <option value="">
                                    Sans categorie
                                </option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $ressource->category ? ($ressource->category->id == $category->id  ? 'selected' : '') : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('category')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Média -->
            <div class=" bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        Contenu multimédia
                    </h2>
                </div>
                <div class="p-6 space-y-8">
                    <!-- Vidéo actuelle et upload -->
                    <div class="space-y-4">
                        <h3 class="text-base font-medium text-gray-900">Vidéo de la ressource</h3>

                        @if($ressource->video_url)
                        <!-- <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 relative">
                            <p class="text-sm font-medium text-gray-700 mb-3">Vidéo actuelle :</p>
                            <div class="max-w-xs h-fit relative">
                                <video
                                    id="video-preview"
                                    width="100%"
                                    height="180"
                                    controls
                                    poster="{{ $ressource->preview_image ? route('secure.file',['id' => $ressource->id]) : '' }}"
                                    class="w-full h-32 object-cover rounded-lg shadow-sm border border-gray-200"
                                    style="pointer-events: none;">
                                    <source src="{{ route('video-link',['videoName'=> $ressource->video_url]) }}" type="video/mp4">
                                    Votre navigateur ne supporte pas la vidéo.
                                </video>
                                <a href="#"
                                    class="absolute right-2 bottom-2 bg-blue-600 hover:bg-blue-700 text-white rounded-full p-2 flex items-center justify-center play-video"
                                    data-video-url="{{ route('video-link',['videoName'=> $ressource->video_url]) }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#exampledsModal"
                                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.15);">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-6.518-3.651A1 1 0 007 8.618v6.764a1 1 0 001.234.97l6.518-1.168A1 1 0 0015 14.382V9.618a1 1 0 00-.248-.45z"></path>
                                    </svg>
                                </a>
                            </div>
                        </div> -->

                        <div class="modal fade" id="exampledsModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="videoModalLabel">Lecture de la vidéo</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                    </div>
                                    <div class="modal-body relative">
                                        <video id="video-player" width="100%" height="400" controls class="w-full bg-black rounded-lg" poster="{{ $ressource->preview_image ? route('secure.file',['id' => $ressource->id]) : '' }}">
                                            Votre navigateur ne supporte pas la vidéo.
                                        </video>
                                        <a href="#"
                                            class="absolute ignite left-0 top-0 w-full h-full bg-black/50   items-center flex justify-center play-video   text-white"
                                            data-video-url=" {{ route('video-link',['videoName'=> $ressource->video_url]) }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#exampledsModal"
                                            style="box-shadow: 0 2px 8px rgba(0,0,0,0.15);">
                                            <i class="fa fa-play text-4xl m-auto p-8 bg-blue-600 hover:bg-blue-700 rounded-full"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-yellow-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-sm text-yellow-800">Aucune vidéo n'est actuellement associée à cette ressource</span>
                            </div>
                        </div>
                        @endif

                        <div>
                            <label for="video_url" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ $ressource->video_url ? 'Remplacer la vidéo' : 'Ajouter une vidéo' }}
                            </label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors">
                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <div class="text-sm text-gray-600">
                                    <label for="video_url" class="cursor-pointer">
                                        <span class="text-blue-600 hover:text-blue-500 font-medium">Cliquez pour choisir</span>
                                        <span> ou glissez-déposez</span>
                                    </label>
                                    <input id="video_url" name="video_url" type="file" accept="video/mp4" class="sr-only">
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Fichiers MP4 uniquement</p>
                            </div>
                        </div>
                    </div>

                    <!-- Image de prévisualisation -->
                    <div class="space-y-4">
                        <h3 class="text-base font-medium text-gray-900">Image de prévisualisation</h3>

                        @if($ressource->preview_image)
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <p class="text-sm font-medium text-gray-700 mb-3">Image actuelle :</p>
                            <div class="max-w-xs h-fit">
                                <img src="{{ route('secure.file',['id' => $ressource->id] ) }}"
                                    alt="Image de prévisualisation"
                                    class="w-full h-32 object-cover rounded-lg relative shadow-sm border border-gray-200">
                            </div>
                        </div>
                        @else
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-sm text-gray-600">Aucune image de prévisualisation</span>
                            </div>
                        </div>
                        @endif

                        <div>
                            <label for="image_file" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ $ressource->image_url ? 'Remplacer l\'image' : 'Ajouter une image' }}
                            </label>

                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors">
                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <div class="text-sm text-gray-600">
                                    <label for="preview_image" class="cursor-pointer">
                                        <span class="text-blue-600 hover:text-blue-500 font-medium">Cliquez pour choisir</span>
                                        <span> ou glissez-déposez</span>
                                    </label>
                                    <input type="file" id="preview_image" name="preview_image" accept="image/*" />
                                </div>
                                <p class="text-xs text-gray-500 mt-1">JPG, PNG, GIF jusqu'à 10MB</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('admin.ressources.index') }}"
                    class="inline-flex items-center px-6 py-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                    Annuler
                </a>
                <button type="submit"
                    class="inline-flex items-center px-8 py-3 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>
@endsection