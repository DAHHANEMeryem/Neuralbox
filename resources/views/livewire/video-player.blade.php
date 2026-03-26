
<div class="container-fluid mt-md-4">
    <style>
    /* ================================
       Styles Généraux
       ================================ */
    .btn-guide {
        position: absolute;
        top: 15px;
        right: 15px;
        background: linear-gradient(135deg, #775b9f, #3aa0c9);
        color: #fff;
        border: none;
        padding: 8px 20px;
        font-size: 14px;
        font-weight: bold;
        border-radius: 25px;
        cursor: pointer;
        z-index: 10;
    }
    
    .bg-lock {
        background-color: #f8f9fa;
        opacity: 0.7;
    }
    
    .bg-purple {
        background-color: #775b9f !important;
        color: white !important;
    }
    
    /* ================================
       Mobile (max-width: 767px)
       ================================ */
    @media (max-width: 767px) {
        /* 1. Titre et Description de la vidéo active */
        #current-video-title {
            font-size: 1.2rem !important;
            line-height: 1.4;
            margin-top: 10px;
            margin-bottom: 5px;
            text-align: right; /* Aligne à droite pour l'arabe */
        }
    
        #current-video-desc {
            font-size: 0.85rem !important;
            line-height: 1.5;
            color: #4b5563;
            text-align: right;
        }
    
        .video-details {
            padding-top: 0 !important;
            margin-top: 10px;
        }
    
        hr {
            margin: 10px 0 !important;
        }
    
        /* 2. Styles de la Playlist (Items) */
        .playlist-item-container {
            padding: 8px !important;
            margin-bottom: 8px !important;
        }
    
        .thumbnail-container {
            width: 100px !important;
        }
    
        .thumbnail-container img {
            height: 60px !important;
        }
    
        .video-title {
            font-size: 0.9rem !important;
            line-height: 1.1;
            margin-bottom: 2px !important;
        }
    
        .video-desc {
            font-size: 0.75rem !important;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    
        .fa-2x {
            font-size: 1.2rem !important;
        }
    }
    </style>
    <div class="row">

        {{-- Section Vidéo --}}
        <div class="col-12 col-md-8 px-0 px-md-2">
            <div class="video-container shadow-xl rounded-md bg-black mb-3" 
                 style="position: relative; overflow: hidden; aspect-ratio: 16/9;">
                <video id="video-player" controls class="w-100 h-100" crossorigin="anonymous"></video>
                <button class="btn-guide" onclick="openGuideModal('{{ $page }}')">
                    📘 {{ $page === 'neuralbox' ? 'الدليل' : 'الموجه' }}
                </button>
            </div>

            <div class="video-details mb-md-4 px-2 px-md-0">
                <h3 id="current-video-title" class="fw-bold text-black display-6">{{ $videoTitle }}</h3>
                <p id="current-video-desc" class="text-gray-700 mt-2">{{ $videoDescription }}</p>
                <hr>
            </div>

            {{-- Formulaire --}}
            @if(Auth::check() && $page === 'neuralbox')
                <div id="rating-form-anchor" class="card border-0 mt-md-4">
                    <div class="card-body">
                        @if(!$isSubmitted)
                            @include('partials.rating-form-content')
                        @else
                            <div class="alert alert-info fs-7"> {{ __('transelt.already_rated') }} </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        {{-- Section Playlist --}}
        <div class="col-12 col-md-4">
            <div class="playlist-sidebar" style="max-height: 80vh; overflow-y:auto;">
                @php $allRessourcesFlat = ($page === 'pedagogie') ? $ressources->flatten() : $ressources; @endphp

                @if($page === 'pedagogie')
                    @foreach($ressources as $categoryName => $items)
                        <div class="category mb-3">
                            <div class="category-header p-2 bg-light rounded cursor-pointer" onclick="toggleCategory(this)">
                                <strong>{{ $categoryName }}</strong>
                                <span class="float-end">&#9660;</span>
                            </div>
                            <div class="category-items mt-2">
                                @foreach($items as $res)
                                    @include('livewire.partials.video-item', ['ressource' => $res, 'flatList' => $allRessourcesFlat])
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @else
                    @foreach($ressources as $res)
                        @include('livewire.partials.video-item', ['ressource' => $res, 'flatList' => $allRessourcesFlat])
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

@script
<script>
let hls = null;
const videoElement = document.getElementById('video-player');

// Configuration de la lecture HLS
function setupHls(url) {
    if (!url) return;
    if (hls) hls.destroy();

    if (Hls.isSupported()) {
        hls = new Hls(); 
        hls.loadSource(url); 
        hls.attachMedia(videoElement);
        hls.on(Hls.Events.MANIFEST_PARSED, () => videoElement.play());
    } else if (videoElement.canPlayType('application/vnd.apple.mpegurl')) {
        videoElement.src = url; 
        videoElement.play();
    }
}

// Initialisation au chargement
setupHls(@json($videoUrl));

// Écouteur pour le changement de vidéo via Livewire
$wire.on('videoChanged', (data) => {
    const info = Array.isArray(data) ? data[0] : data;
    setupHls(info.url);
    document.getElementById('current-video-title').innerText = info.title;
    document.getElementById('current-video-desc').innerText = info.description || '';

    setTimeout(() => {
        const playlistContainer = document.querySelector('.playlist-sidebar');
        const activeItem = document.querySelector('.bg-purple') || document.querySelector('.border-white');

        if (activeItem && playlistContainer) {
            const topPos = activeItem.offsetTop - playlistContainer.offsetTop;
            playlistContainer.scrollTo({
                top: topPos,
                behavior: 'smooth'
            });
        }
    }, 300);
});

// Gestion de la fin de la vidéo
videoElement.onended = function() {
    @if(!Auth::check())
        showSubscriptionPopup();
        return;
    @endif

    const anchor = document.getElementById('rating-form-anchor');
    if(anchor) anchor.scrollIntoView({ behavior: 'smooth' });

    const currentId = parseInt(@this.currentVideoId);
    $wire.call('markVideoCompleted', currentId).then(() => {
        const allVideos = @json($allRessourcesFlat->pluck('id'));
        const currentIndex = allVideos.indexOf(currentId);

        if (currentIndex >= 0 && currentIndex < allVideos.length - 1) {
            $wire.call('selectVideo', allVideos[currentIndex + 1]);
        }
    });
};

// Fonctions globales
window.toggleCategory = (el) => {
    const items = el.nextElementSibling;
    items.style.display = (items.style.display === 'none') ? 'block' : 'none';
};

window.showSubscriptionPopup = () => {
    const modalEl = document.getElementById('subscriptionModal');
    if (modalEl) {
        const modal = new bootstrap.Modal(modalEl);
        modal.show();
    }
};

window.showProgressionPopup = () => {
    const modalEl = document.getElementById('progressionModal');
    if (modalEl) {
        const modal = new bootstrap.Modal(modalEl);
        modal.show();
    }
};
</script>
@endscript