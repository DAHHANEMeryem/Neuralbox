
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="video-container shadow-sm rounded bg-black mb-3" style="position: relative; overflow: hidden; aspect-ratio: 16/9;">
                <video id="video-player" controls class="w-100 h-100" crossorigin="anonymous"></video>
            </div>

            <div class="video-details mb-4">
                <h3 class="fw-bold">{{ $currentVideo->titre }}</h3>
                <hr>
                <div class="description p-3 bg-light rounded">
                    {!! trans("neuralbox.desc") !!}
                </div>
            </div>

            @auth
                @if(!$isSubmitted)
                    <div class="rating-section card border-0 shadow-sm mt-4">
                        <div class="card-body">
                            <h5 class="mb-3 fw-bold">Evaluate this Resource</h5>
                            @include('partials.rating-form-content') 
                        </div>
                    </div>
                @else
                    <div class="alert alert-info">You have already evaluated this video. Thank you!</div>
                @endif
            @endauth
        </div>

        <div class="col-lg-4">
            <h5 class="fw-bold mb-3">Up Next</h5>
            <div class="playlist-sidebar overflow-auto" style="max-height: 80vh;">
                @foreach($ressources as $ressource)
                    <div 
                        wire:click="selectVideo({{ $ressource->id }})" 
                        class="d-flex mb-3 cursor-pointer p-2 rounded {{ $currentVideo->id == $ressource->id ? 'bg-primary-subtle' : '' }}"
                        style="cursor: pointer; transition: 0.3s;"
                    >
                        <div class="flex-shrink-0" style="width: 160px;">
                            <img src="{{ asset('assets/img/covers/thumb.jpg') }}" class="img-fluid rounded" alt="thumbnail">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1 fw-bold text-dark">{{ $ressource->titre }}</h6>
                            <small class="text-muted">NeuralBox Academy</small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@script
<script>
    let hls = null;
    const video = document.getElementById('video-player');

    function setupHls(url) {
        if (hls) { hls.destroy(); }
        
        if (Hls.isSupported()) {
            hls = new Hls();
            hls.loadSource(url);
            hls.attachMedia(video);
            hls.on(Hls.Events.MANIFEST_PARSED, () => video.play());
        } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
            video.src = url;
            video.addEventListener('loadedmetadata', () => video.play());
        }
    }

    // Initial Load
    setupHls("{{ route('video-link', ['videoName' => $currentVideo->video_url]) }}");

    // Listen for Livewire updates
    $wire.on('videoChanged', (event) => {
        setupHls(event.url);
    });
</script>
@endscript