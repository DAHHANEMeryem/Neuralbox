@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">➕ Ajouter une ressource</h1>
    <form id="uploadForm" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="titre" class="block font-semibold">Titre</label>
            <input type="text" name="titre" id="titre" class="w-full border rounded px-3 py-2" required>
            @error('titre')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block font-semibold">Description</label>
            <textarea name="description" id="description" rows="3" class="w-full border rounded px-3 py-2"></textarea>
            @error('description')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="video_file" class="block font-semibold">Vidéo (fichier MP4)</label>
            <input type="file" name="video_url" id="video_url" accept="video/mp4" class="w-full border rounded px-3 py-2">
            @error('video_url')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="preview_image" class="block font-semibold">Image de prévisualisation</label>
            <input type="file" name="preview_image" id="preview_image" accept="image/*" class="w-full border rounded px-3 py-2">
            @error('preview_image')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="ordre" class="block font-semibold">Ordre d'affichage</label>
            <input type="number" name="ordre" id="ordre" class="w-full border rounded px-3 py-2" value="0" min="0">
            @error('ordre')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="categorie" class="block font-semibold">Catégorie</label>
            <select name="categorie" id="categorie" class="w-full border rounded px-3 py-2" required>
                <option value="pedagogie">Pédagogie</option>
                <option value="neuralbox">محتوى نيورال بوكس</option>
            </select>
            @error('categorie')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="visibilite" class="block font-semibold">Visibilité</label>
            <select name="visibilite" id="visibilite" class="w-full border rounded px-3 py-2" required>
                <option value="tous">Tout le monde</option>
                <option value="abonne">Abonnés uniquement</option>
            </select>
            @error('visibilite')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <!-- Progress bar -->
        <div class="progress d-none mb-3" id="uploadProgress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%">0%</div>
        </div>

        <button type="submit" id="submitBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Ajouter la ressource
        </button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
        document.getElementById('uploadForm').addEventListener('submit', function(e) {
            e.preventDefault();

            let form = e.target;
            console.log(form);
            
            let formData = new FormData(form);

            let progressContainer = document.getElementById('uploadProgress');
            let progressBar = progressContainer.querySelector('.progress-bar');
            let submitBtn = document.getElementById('submitBtn');

            // show progress bar
            progressContainer.classList.remove('d-none');
            progressBar.style.width = '0%';
            progressBar.innerText = '0%';
            submitBtn.disabled = true;

            axios.post("{{ route('admin.ressources.store') }}", formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    },
                    onUploadProgress: function(progressEvent) {
                        if (progressEvent.total) {
                            let percent = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                            progressBar.style.width = percent + '%';
                            progressBar.innerText = 'Uploading ' + percent + '%';
                        }
                    }
                })
                .then(function(response) {
                    progressBar.classList.remove('progress-bar-animated');
                    progressBar.classList.add('bg-success');
                    progressBar.innerText = "Upload complete!";
                    // Optional: redirect or show success message
                })
                .catch(function(error) {
                    console.log(error);
                    
                    progressBar.classList.remove('progress-bar-animated');
                    progressBar.classList.add('bg-danger');
                    progressBar.innerText = "Upload failed!";
                })
                .finally(() => {
                    submitBtn.disabled = false;
                });
        });
</script>
@endsection