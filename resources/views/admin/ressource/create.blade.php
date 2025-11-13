@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto p-8 bg-white rounded-xl shadow-2xl">
    <h1 class="text-3xl font-extrabold mb-6 text-gray-800 flex items-center">
        <span class="mr-2">➕</span> Ajouter une ressource
    </h1>
    <form id="uploadForm" enctype="multipart/form-data">
        @csrf

        {{-- Resource Details Section --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            {{-- Titre (Title) --}}
            <div>
                <label for="titre" class="block text-sm font-semibold text-gray-700 mb-1">Titre <span class="text-red-500">*</span></label>
                <input type="text" name="titre" id="titre" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3" required>
                @error('titre')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Ordre d'affichage (Display Order) --}}
            <div>
                <label for="ordre" class="block text-sm font-semibold text-gray-700 mb-1">Ordre d'affichage</label>
                <input type="number" name="ordre" id="ordre" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3" value="0" min="0">
                @error('ordre')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Description --}}
        <div class="mb-6">
            <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
            <textarea name="description" id="description" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3"></textarea>
            @error('description')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- File Uploads Section --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            {{-- Vidéo (MP4 File) --}}
            <div>
                <label for="video_url" class="block text-sm font-semibold text-gray-700 mb-1">Vidéo (fichier MP4) <span class="text-red-500">*</span></label>
                <input type="file" name="video_url" id="video_url" accept="video/mp4" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none p-2.5">
                <p class="mt-1 text-sm text-gray-500" id="video_helper_text">Max 1 GB (handled with chunk upload)</p>
                @error('video_url')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Image de prévisualisation (Preview Image) --}}
            <div>
                <label for="preview_image" class="block text-sm font-semibold text-gray-700 mb-1">Image de prévisualisation</label>
                <input type="file" name="preview_image" id="preview_image" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none p-2.5">
                @error('preview_image')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Category and Visibility Section --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            {{-- Catégorie Principale (Main Category) --}}
            <div>
                <label for="categorie" class="block text-sm font-semibold text-gray-700 mb-1">Catégorie Principale <span class="text-red-500">*</span></label>
                <select name="categorie" id="categorie" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3" required>
                    <option value="pedagogie">Pédagogie</option>
                    <option value="neuralbox">محتوى نيورال بوكس</option>
                </select>
                @error('categorie')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Visibilité (Visibility) --}}
            <div>
                <label for="visibilite" class="block text-sm font-semibold text-gray-700 mb-1">Visibilité <span class="text-red-500">*</span></label>
                <select name="visibilite" id="visibilite" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3" required>
                    <option value="tous">Tout le monde</option>
                    <option value="abonne">Abonnés uniquement</option>
                </select>
                @error('visibilite')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Catégorie Détaillée du Vidéo (Detailed Video Category) --}}
            <div>
                {{-- Corrected ID and Name: Using 'video_category_id' to prevent conflict with 'categorie' --}}
                <label for="video_category_id" class="block text-sm font-semibold text-gray-700 mb-1">Catégorie détaillée du vidéo</label>
                <select id="video_category_id" name="video_category_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3">
                    <option value="" selected>Sans catégorie</option>
                    {{-- Assuming $categories is passed from the controller --}}
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
                @error('video_category_id')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        ---

        {{-- Progress bar (Styled with Tailwind equivalent classes) --}}
        <div class="hidden mb-6" id="uploadProgressContainer">
            <h2 class="text-lg font-semibold mb-2 text-gray-700">Progression de l'upload</h2>
            <div class="w-full bg-gray-200 rounded-full h-4">
                <div id="uploadProgressBar" class="bg-blue-600 h-4 rounded-full text-xs text-white text-center transition-all duration-300" style="width: 0%">0%</div>
            </div>
            <p id="uploadStatusText" class="mt-2 text-sm text-gray-600">En attente de fichier...</p>
        </div>

        <button type="submit" id="submitBtn" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition-colors duration-200 disabled:opacity-50" disabled>
            Ajouter la ressource
        </button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/resumablejs@1/resumable.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const videoInput = document.getElementById('video_url');
        const submitBtn = document.getElementById('submitBtn');
        const form = document.getElementById('uploadForm');
        const progressContainer = document.getElementById('uploadProgressContainer');
        const progressBar = document.getElementById('uploadProgressBar');
        const statusText = document.getElementById('uploadStatusText');

        const resumable = new Resumable({
            // Ensure this route exists and handles chunk upload
            target: "{{ route('admin.ressources.uploadChunk') }}",
            chunkSize: 5 * 1024 * 1024, // 5MB chunks (reduced for better server handling)
            simultaneousUploads: 3,
            testChunks: false,
            query: {
                _token: "{{ csrf_token() }}"
            }
        });

        // 1. Assign file input for Resumable.js
        resumable.assignBrowse(videoInput);

        // 2. Disable button until file is selected and form is complete
        function checkFormValidity() {
            const isVideoSelected = videoInput.files.length > 0 || resumable.files.length > 0;
            const isTitleFilled = document.getElementById('titre').value.trim() !== '';
            const isCategorieSelected = document.getElementById('categorie').value.trim() !== '';
            const isVisibiliteSelected = document.getElementById('visibilite').value.trim() !== '';

            // Only enable the submit button if the video has been successfully uploaded (fileSuccess event)
            // or if a new video file is selected (for initial state).
            // We will disable it when upload starts and re-enable it on failure or a special flag on success.
            // For now, let's keep it simple: allow submission if not uploading.
            submitBtn.disabled = true; // Start with disabled and rely on fileSuccess to enable (or upload on selection).

            // Re-enable if no file is being uploaded, but is required. This is for initial state only.
            // A better solution is to only allow form submission after 'fileSuccess'
        }

        // Initial check and listeners for required fields
        form.querySelectorAll('input, select, textarea').forEach(el => {
            el.addEventListener('input', checkFormValidity);
        });

        // 3. Handle file selection
        resumable.on('fileAdded', function(file) {
            // Check if file is actually a video file as expected
            if (!file.fileName.toLowerCase().endsWith('.mp4')) {
                statusText.textContent = `Erreur: Le fichier doit être un MP4.`;
                progressBar.style.backgroundColor = '#ef4444'; // Red
                resumable.removeFile(file);
                return;
            }

            // Prepare UI for upload
            progressContainer.classList.remove('hidden');
            progressBar.style.width = '0%';
            progressBar.classList.add('bg-blue-600');
            progressBar.classList.remove('bg-green-500', 'bg-red-500');
            progressBar.textContent = '0%';
            statusText.textContent = `Téléchargement de: ${file.fileName}`;
            submitBtn.disabled = true; // Disable submit during upload

            resumable.upload(); // Start the upload process
        });

        // 4. Handle progress
        resumable.on('fileProgress', function(file) {
            let percent = Math.floor(file.progress() * 100);
            progressBar.style.width = percent + '%';
            progressBar.textContent = percent + '%';
            statusText.textContent = `Téléchargement de ${file.fileName} (${percent}%)`;
        });

        // 5. Handle chunk upload success
        resumable.on('fileSuccess', function(file) {
            progressBar.style.width = '100%';
            progressBar.textContent = '100%';
            progressBar.classList.remove('bg-blue-600');
            progressBar.classList.add('bg-yellow-500'); // Use yellow for merging state
            statusText.textContent = 'Téléchargement terminé. Fusion des morceaux en cours...';

            // All chunks uploaded, now merge them and submit form data
            const formInputs = {
                identifier: file.uniqueIdentifier,
                filename: file.fileName,
                titre: document.getElementById('titre').value,
                categorie: document.getElementById('categorie').value,
                visibilite: document.getElementById('visibilite').value,
                description: document.getElementById('description').value,
                ordre: document.getElementById('ordre').value,
                // The 'preview_image' is not automatically handled by Resumable.js, it must be part of the final form submission.
                // It is better to use a general FormData object for the final submission.

                // Corrected ID to retrieve value
                video_category_id: document.getElementById('video_category_id').value,
                _token: '{{ csrf_token() }}' // Add CSRF token for fetch
            };

            // Prepare FormData for the merge and resource creation
            const formData = new FormData();
            for (const key in formInputs) {
                formData.append(key, formInputs[key]);
            }

            // Manually append the preview image file if present
            const previewImageFile = document.getElementById('preview_image').files[0];
            if (previewImageFile) {
                formData.append('preview_image', previewImageFile);
            }

            // Send merge request via Fetch API
            fetch("{{ route('admin.ressources.mergeChunks') }}", {
                    method: "POST",
                    // No 'Content-Type': 'multipart/form-data' header needed; Fetch adds it automatically with boundary when using FormData
                    body: formData
                })
                .then(res => {
                    if (!res.ok) {
                        // Handle HTTP error statuses
                        return res.json().then(error => Promise.reject(error));
                    }
                    return res.json();
                })
                .then(data => {
                    // Final success
                    progressBar.classList.remove('bg-yellow-500');
                    progressBar.classList.add('bg-green-500'); // Green for final success
                    statusText.textContent = data.message || `Ressource ${data.ressource_id} ajoutée avec succès.`;
                    // Optionally: Redirect or clear form
                    submitBtn.disabled = false; // Re-enable if you want to allow a new upload
                    // window.location.href = data.redirect_url; 

                })
                .catch(error => {
                    // Final merge/creation failure
                    console.error('Erreur lors de la fusion/création:', error);
                    progressBar.classList.remove('bg-yellow-500');
                    progressBar.classList.add('bg-red-500'); // Red for error
                    let errorMessage = 'Erreur inconnue.';
                    if (error.errors) {
                        // Laravel validation errors
                        errorMessage = Object.values(error.errors).flat().join(' | ');
                    } else if (error.message) {
                        // General server error
                        errorMessage = error.message;
                    }
                    statusText.textContent = `Erreur: ${errorMessage}. Veuillez vérifier la console.`;
                    submitBtn.disabled = false;
                });
        });

        // 6. Handle chunk upload failure
        resumable.on('fileError', function(file, message) {
            console.error('Upload Error:', message);
            progressBar.classList.add('bg-red-500');
            statusText.textContent = `Erreur lors de l'upload des morceaux : ${message}.`;
            submitBtn.disabled = false;
        });

        // Prevent standard form submission as we use Resumable.js and Fetch for the final step
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Logic check: if no video was selected, but submit was hit, alert user.
            if (resumable.files.length === 0) {
                statusText.textContent = "Veuillez sélectionner un fichier vidéo MP4.";
                progressBar.classList.add('bg-red-500');
                progressContainer.classList.remove('hidden');
                submitBtn.disabled = false; // Re-enable for retry
            }

            // If the user clicks submit *after* the file has successfully chunked, 
            // the Resumable 'fileSuccess' handler should have already triggered the final POST request.
            // We just ensure the button is disabled during the full process.
        });

        // Initial state: If there's no file selected, the button should be disabled
        checkFormValidity();
    });
</script>
@endsection