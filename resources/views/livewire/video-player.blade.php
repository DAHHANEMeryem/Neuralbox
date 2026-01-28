<div class="container-fluid mt-md-4">
    <div class="row">
        <div class="col-12 px-0 px-md-2 col-md-8">
            <div class="video-container shadow-xl rounded-md bg-black mb-3 " style="position: relative; overflow: hidden; aspect-ratio: 16/9;">
                <video id="video-player" controls class="w-100 h-100" crossorigin="anonymous"></video>
            </div>
            <div class="video-details mb-md-4">
                <h3 class="fw-bold text-black display-6">{{ $videoTitle }}</h3>
                <hr>
                {{-- <div class="description p-3 bg-light rounded">
                    {!! trans("neuralbox.desc") !!}
                </div> --}}
            </div>

            @if(Auth::check() && $page === 'neuralbox')
                @if(!$isSubmitted)
                    <div class="rating-section card border-0 mt-md-4">
                        <div class="card-body">
                            {{-- <h5 class="mb-3 fw-bold">{{__('')}}</h5> --}}
                            @include('partials.rating-form-content')
                        </div>
                    </div>
                @else
                    <div class="alert alert-info fs-7 ">{{ __('transelt.already_rated') }}</div>
                @endif
            @endif
        </div>

        <div class="col-lg-4 z-10 overflow-visible">
            {{-- <h5 class="fw-bold mb-3">{{ $page }}</h5> --}}
            <div class="playlist-sidebar" style="max-height: 80vh;">´
                @if ($page == 'pedagogie')
                    @foreach($ressources as $categoryName => $items)
                        <div class="category-header d-flex align-items-center py-2 px-3 mb-2 bg-light rounded-pill sticky-top">
                            <span class="fw-bold text-uppercase ">{{ __('ressources.unit') }}&nbsp;{{ __('ressources.'.$loop->index +1) }}:&nbsp;{{ $categoryName }}</span>
                            <span class="badge bg-secondary rounded-pill">{{ count($items) }}</span>
                        </div>

                        @foreach($items as $ressource)
                            @php
                                $locked = !$isSubscribed && $ressource->visibilite != 'tous' && !$ressource->is($items->first());
                            @endphp
                            
                            <div
                                @if(!$locked) 
                                    wire:click="selectVideo({{ $ressource->id }})" 
                                @else 
                                    onclick="showSubscriptionPopup()" 
                                @endif
                                class="position-relative d-flex mb-3 shadow cursor-pointer p-2 rounded {{ $locked ? 'bg-lock' : '' }} {{ $currentVideoId == $ressource->id ? 'bg-purple' : '' }}"
                                style="cursor: pointer; transition: 0.3s;">
                                @if ($locked)
                                    <div class="position-absolute top-0 rounded overlay w-100 h-100 start-0 d-flex justify-content-center align-items-center">
                                        <i class="fas fa-lock text-white fa-lg"></i>
                                    </div>
                                @endif
                                <div class="flex-shrink-0 thumbnail col-5 ">
                                    <img src="{{ route('secure.file',['type' => 'ressource','id' => $ressource->id]) }}" class="img-fluid rounded" alt="thumbnail">
                                </div>
                                <div class="flex-grow-1 me-3  col-7">
                                    <h6 class="mb-1 fw-bold  {{ $currentVideoId == $ressource->id ? 'text-white' : 'text-dark' }}">{{ $ressource->titre }}</h6>
                                    <small class="truncate-multiline fs-7 {{ $currentVideoId == $ressource->id ? 'text-white' : 'text-muted' }}">{{ $ressource->description }}</small>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                @else
                    @foreach($ressources as $ressource)
                    @php
                        $locked = !$isSubscribed && $ressource->visibilite != 'tous' ;
                    @endphp
                    <div
                        @if (!$locked)
                        wire:click="selectVideo({{ $ressource->id }})"
                        @else 
                            onclick="showSubscriptionPopup()" 
                        @endif
                        class="position-relative d-flex mb-3 shadow cursor-pointer p-2 rounded {{ $locked ? 'bg-lock' : '' }} {{ $currentVideoId == $ressource->id ? 'bg-purple' : '' }}"
                        style="cursor: pointer; transition: 0.3s;">
                        @if ($locked)
                            <div class="position-absolute top-0 rounded overlay w-100 h-100 start-0 d-flex justify-content-center align-items-center">
                                <i class="fas fa-lock text-white fa-lg"></i>
                            </div>
                        @endif
                        <div class="flex-shrink-0 thumbnail col-5 ">
                            <img src="{{ route('secure.file',['type' => 'ressource','id' => $ressource->id]) }}" class="img-fluid rounded" alt="thumbnail">
                        </div>
                        <div class="flex-grow-1 me-3  col-7">
                            <h6 class="mb-1 fw-bold  {{ $currentVideoId == $ressource->id ? 'text-white' : 'text-dark' }}">{{ $ressource->titre }}</h6>
                            <small class="truncate-multiline fs-7 {{ $currentVideoId == $ressource->id ? 'text-white' : 'text-muted' }}">{{ $ressource->description }}</small>
                        </div>
                    </div>
                    @endforeach
                    @endif
            </div>
        </div>
    </div>
</div>

<script>
    function showSubscriptionPopup() {
        // Initialize and show the Bootstrap modal
        var myModal = new bootstrap.Modal(document.getElementById('subscriptionModal'));
        myModal.show();
    }

</script>
@script
<script>

    
    let hls = null;
    const video = document.getElementById('video-player');

    function setupHls(url) {
        if (hls) {
            hls.destroy();
        }

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
    @if($videoUrl)
        setupHls("{{ route('video-link', ['videoName' => $videoUrl]) }}");
    @endif
    // Listen for Livewire updates
    $wire.on('videoChanged', (event) => {
        setupHls(event.url);
    });
</script>
@endscript