<div class="container-fluid mt-md-4">
    <div class="row">

        <!-- VIDEO PLAYER -->
        <div class="col-12 px-0 px-md-2 col-md-8">
            <div class="video-container shadow-xl rounded-md bg-black mb-3"
                 style="position: relative; overflow: hidden; aspect-ratio: 16/9;">
                <video id="video-player"
                       controls
                       class="w-100 h-100"
                       crossorigin="anonymous">
                </video>
            </div>

            <!-- VIDEO DETAILS -->
            <div class="video-details mb-md-4">
                <h3 class="fw-bold text-black display-6">{{ $videoTitle }}</h3>
                @if(!empty($videoDescription))
                    <p class="text-gray-700 mt-2">{{ $videoDescription }}</p>
                @endif
                <hr>
            </div>

            <!-- RATING FORM -->
            @if(Auth::check() && $page === 'neuralbox')
                @if(!$isSubmitted)
                    <div class="rating-section card border-0 mt-md-4">
                        <div class="card-body">
                            @include('partials.rating-form-content')
                        </div>
                    </div>
                @else
                    <div class="alert alert-info fs-7">
                        {{ __('transelt.already_rated') }}
                    </div>
                @endif
            @endif
        </div>

        <!-- PLAYLIST SIDEBAR -->
        <div class="col-lg-4 z-10 overflow-visible">
            <div class="playlist-sidebar" style="max-height: 80vh; overflow-y:auto;">

                @if($page === 'pedagogie')
                    @foreach($ressources as $categoryName => $items)
                        <div class="category mb-3" wire:key="category-{{ $loop->index }}">
                            <!-- HEADER DE LA CATEGORIE -->
                            <div class="category-header p-2 bg-light rounded cursor-pointer"
                                 onclick="toggleCategory(this)">
                                <strong>{{ __('ressources.unit') }} {{ $loop->iteration }}: {{ $categoryName }}</strong>
                                <span class="badge bg-secondary ms-2">{{ count($items) }}</span>
                                <span class="float-end">&#9660;</span> <!-- flèche -->
                            </div>

                            <!-- LISTE DES VIDEOS -->
                            <div class="category-items mt-2" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease;">
                                @foreach($items as $ressource)
                                    @php
                                        $isSubscribed = Auth::check() && (Auth::user()->has_access || Auth::user()->is_admin);
                                        $locked = !$isSubscribed && $ressource->visibilite != 'tous';
                                    @endphp

                                    <div wire:key="ressource-{{ $ressource->id }}"
                                         @if(!$locked)
                                            wire:click="selectVideo({{ $ressource->id }})"
                                         @else
                                            onclick="showSubscriptionPopup()"
                                         @endif
                                         class="d-flex mb-2 shadow cursor-pointer p-2 rounded
                                                {{ $locked ? 'bg-lock' : '' }}
                                                {{ $currentVideoId == $ressource->id ? 'bg-purple' : '' }}">

                                        @if($locked)
                                            <div class="position-absolute top-0 rounded overlay w-100 h-100 start-0 d-flex justify-content-center align-items-center">
                                                <i class="fas fa-lock text-white fa-lg"></i>
                                            </div>
                                        @endif

                                        <!-- THUMBNAIL -->
                                        <div class="flex-shrink-0 thumbnail col-5">
                                            <img src="{{ route('secure.file',['type'=>'ressource','id'=>$ressource->id]) }}"
                                                 class="img-fluid rounded" alt="thumbnail">
                                        </div>

                                        <!-- TEXTE -->
                                        <div class="flex-grow-1 me-3 col-7">
                                            <h6 class="mb-1 fw-bold
                                                {{ $currentVideoId == $ressource->id ? 'text-white' : 'text-dark' }}">
                                                {{ $ressource->titre }}
                                            </h6>
                                            <small class="truncate-multiline fs-7
                                                {{ $currentVideoId == $ressource->id ? 'text-white' : 'text-muted' }}">
                                                {{ $ressource->description }}
                                            </small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- MODE NEURALBOX : LISTE SIMPLE -->
                    @foreach($ressources as $ressource)
                        @php
                            $isSubscribed = Auth::check() && (Auth::user()->has_access || Auth::user()->is_admin);
                            $locked = !$isSubscribed && $ressource->visibilite != 'tous';
                        @endphp

                        <div wire:key="ressource-{{ $ressource->id }}"
                             @if(!$locked)
                                wire:click="selectVideo({{ $ressource->id }})"
                             @else
                                onclick="showSubscriptionPopup()"
                             @endif
                             class="position-relative d-flex mb-3 shadow cursor-pointer p-2 rounded
                                    {{ $locked ? 'bg-lock' : '' }}
                                    {{ $currentVideoId == $ressource->id ? 'bg-purple' : '' }}">

                            @if($locked)
                                <div class="position-absolute top-0 rounded overlay w-100 h-100 start-0 d-flex justify-content-center align-items-center">
                                    <i class="fas fa-lock text-white fa-lg"></i>
                                </div>
                            @endif

                            <!-- THUMBNAIL -->
                            <div class="flex-shrink-0 thumbnail col-5">
                                <img src="{{ route('secure.file',['type'=>'ressource','id'=>$ressource->id]) }}"
                                     class="img-fluid rounded" alt="thumbnail">
                            </div>

                            <!-- TEXTE -->
                            <div class="flex-grow-1 me-3 col-7">
                                <h6 class="mb-1 fw-bold
                                    {{ $currentVideoId == $ressource->id ? 'text-white' : 'text-dark' }}">
                                    {{ $ressource->titre }}
                                </h6>
                                <small class="truncate-multiline fs-7
                                    {{ $currentVideoId == $ressource->id ? 'text-white' : 'text-muted' }}">
                                    {{ $ressource->description }}
                                </small>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>

    </div>
</div>

<!-- MODAL SUBSCRIPTION -->
<script>
function showSubscriptionPopup() {
    var myModal = new bootstrap.Modal(document.getElementById('subscriptionModal'));
    myModal.show();
}

// Toggle slide pour sidebar pédagogique
function toggleCategory(header) {
    const items = header.nextElementSibling;
    if(items.style.maxHeight && items.style.maxHeight !== '0px'){
        items.style.maxHeight = '0';
    } else {
        items.style.maxHeight = items.scrollHeight + 'px';
    }
}
</script>

<!-- HLS.js VIDEO PLAYER -->
@script
<script>
let hls = null;
const videoElement = document.getElementById('video-player');

function setupHls(url) {
    if (!url) return;

    if (hls) {
        hls.destroy();
    }

    if (Hls.isSupported()) {
        hls = new Hls();
        hls.loadSource(url);
        hls.attachMedia(videoElement);

        hls.on(Hls.Events.MANIFEST_PARSED, () => {
            videoElement.play().catch(e => console.log("Autoplay bloqué ou erreur :", e));
        });

    } else if (videoElement.canPlayType('application/vnd.apple.mpegurl')) {

        videoElement.src = url;
        videoElement.addEventListener('loadedmetadata', () => videoElement.play());
    }
}

// Charger la vidéo initiale
const initialUrl = @json($videoUrl);
if (initialUrl) setupHls(initialUrl);

// Écouter le changement de vidéo via Livewire
$wire.on('videoChanged', (event) => {
    setupHls(event.url);
});
</script>
@endscript