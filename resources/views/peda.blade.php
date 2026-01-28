@extends('layouts.app')

@section('title', 'نيورال بوكس | الدليل البيداغوجي')

{{-- @section('background', 'url(images/peda/1.png)')

@section('content')
<div class="peda-page">

  <section class="page-content pt-md-4 pt-1 pb-0 peda">
    <div class="container">
      <div class="teacher-single-page mb-0">
        <div class="row justify-content-between">
          <div class="col-lg-5 p-md-4">
            <div class="teacher-content">

              <p>{!! trans("peda.desc")!!}</p>

              <!-- <button class=" btn-default text-xl ps-4 py-2 h-auto ">{{__("peda.watch_now")}}<i class="fa fa-long-arrow-alt-right"></i></button> -->

            </div><!--teacher-content end-->
          </div>
          <div class="col-lg-6 justify-start">
            <div class="teacher-coly rounded-4 overflow-hidden">
              <a class="play-video  overlay-box" poster="images/peda/1.png">
                <img src="{{ asset('assets/img/covers/why_neural.jpg') }}" class="w-100 h-auto" alt="">
              </a>
              <a data-video-url="{{ route('video-link', ['videoName' => 'intro']) }}"
                data-bs-toggle="modal"
                data-bs-target="#exampledsModal"
                data-form="false"
                class="video-play play-video overlay-box">
                <img src="assets/img/play.png" alt="">
              </a>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  @php

  $subscribed = false;
  if(Auth::check())
  $subscribed = Auth::check() && (Auth::user()->subscription_type =="golden" || Auth::user()->is_admin);
  $linkAttrs = [
  'class' => $subscribed ? 'play-video private fs-4 text-white' : ' disabled-link opacity-50 fs-4 text-white',
  ];
  @endphp
  <div class="videos-slide pb-5 position-relative">
    <div class="accordion  categories-list" id="accordionExample">
      @foreach($ressourcesGrouped as $categoryName => $ressources)
      <div class="accordion-item">
        <h2 class="accordion-header" id="heading-{{ Str::slug($categoryName) }}">
          <button class="accordion-button collapsed fs-2 text-white fw-bold fill-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ Str::slug($categoryName) }}" aria-expanded="false" aria-controls="collapse-{{ Str::slug($categoryName) }}">
            {{ $categoryName }}
          </button>
        </h2>
        <div id="collapse-{{ Str::slug($categoryName) }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ Str::slug($categoryName) }}" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <ul class="list-unstyled mb-0">
              @foreach($ressources as $ressource)
              <li class="ps-md-4  mx-md-4 mb-4">
                @if ($ressource->visibilite == 'tous')
                <a href="#"
                  class="play-video fs-4 text-white"
                  data-bs-toggle="modal"
                  data-bs-target="#exampledsModal"
                  data-video-url="{{ route('video-link', ['videoName' => $ressource->video_url]) }}"
                  data-video-title="{{ $ressource->titre }}"
                  data-order="{{ $ressource->ordre }}"
                  data-video-id="{{$ressource->id}}">
                  {{ $ressource->titre }}
                </a>
                @else
                <a @if($subscribed)
                  data-video-url="{{ route('video-link', ['videoName' => $ressource->video_url]) }}"
                  data-bs-toggle="modal"
                  data-bs-target="#exampledsModal"
                  data-video-title="{{ $ressource->titre }}"
                  data-order="{{ $ressource->ordre }}"
                  data-video-id="{{$ressource->id}}"
                  @else
                  href="javascript:void(0)" onclick="showPopup()"
                  @endif
                  @foreach($linkAttrs as $attr=> $value)
                  {{ $attr }}="{{ $value }}"
                  @endforeach
                  >
                  {{ $ressource->titre }}
                </a>
                @endif
                
              </li>


              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
      @endforeach

    </div>
</div>

@endsection


@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {

    const nextBtn = document.querySelector('.next-btn');
    const prevBtn = document.querySelector('.prev-btn');

    if (nextBtn) nextBtn.addEventListener('click', () => navigateVideo('next'));
    if (prevBtn) prevBtn.addEventListener('click', () => navigateVideo('prev'));

    let ressources = <?php echo json_encode($ressourcesGrouped, true) ?>;
    console.log(ressources);

    const $spinner = $("#global-spinner");

    const videoModalElement = document.getElementById('exampledsModal');
    const videoModal = new bootstrap.Modal(videoModalElement);
    const videoPlayer = document.getElementById('video-player');
    const videoTitle = document.getElementById('video-title');
    let hls = null;
    let currentVideoId = 1;

    let length =
      <?php
      $length = 1;
      foreach ($ressourcesGrouped as $categoryName => $ressources) {
        $length++;
      }
      echo $length
      ?>;


    function loadVideo(videoData) {
      console.log(videoData);

      const videoSrc = videoData.video_url;
      currentVideoId = videoData.id;

      if (videoData.order - 1 == 0) {
        prevBtn.classList.add('d-none');
      } else {
        prevBtn.classList.remove('d-none');
      }

      if (videoData.order == length) {
        nextBtn.classList.add('d-none');
      } else {
        nextBtn.classList.remove('d-none');
      }

      $spinner.css("display", "flex");

      videoPlayer.pause();
      videoPlayer.removeAttribute('src');
      if (hls) {
        hls.destroy();
        hls = null;
      }

      if (window.Hls && Hls.isSupported()) {
        hls = new Hls();
        hls.loadSource(videoSrc);
        hls.attachMedia(videoPlayer);
        hls.on(Hls.Events.MANIFEST_PARSED, function() {
          videoPlayer.play();
        });
      } else {
        videoPlayer.src = videoSrc;
        videoPlayer.play();
      }

      $spinner.css("display", "none");

      const titleEl = document.querySelector('#video-title');
      if (titleEl) titleEl.innerText = videoData.title;

      videoModal.show();
    }

    document.querySelectorAll('.play-video').forEach(function(el) {
      el.addEventListener('click', function(e) {
        e.preventDefault();

        const videoData = {
          id: this.getAttribute('data-video-id'),
          video_url: this.getAttribute('data-video-url'),
          title: this.getAttribute('data-video-title') || '',
          order: this.getAttribute('data-order') || '',
        };
        if (!videoData.id || !videoData.video_url) return;
        loadVideo(videoData);
      });
    });

    function navigateVideo(direction) {
      $.ajax({
        url: '/ressources/navigate',
        method: 'POST',
        data: {
          id: currentVideoId,
          direction: direction,
          category: 'pedagogie',
          _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
        },
        success: function(response) {
          loadVideo(response);
        },
        error: function(e) {
          console.log(e);

          alert(`No ${direction} video found`);
        }
      });
    }


    videoModalElement.addEventListener('hidden.bs.modal', function() {
      videoPlayer.pause();
      videoPlayer.currentTime = 0;
      videoPlayer.removeAttribute('src');
      if (hls) {
        hls.destroy();
        hls = null;
      }
    });
  });
</script>
@endsection
<div class="modal fade overflow-hidden video-learning-modal vh-100" id="exampledsModal" aria-labelledby="exampledsModalLabel" aria-hidden="true">
  <div class="modal-dialog m-auto   modal-xl  modal-dialog-centered">
    <div class="modal-content vh-100 bg-transparent flex-row-reverse   border-0 shadow-lg">
      <div class="modal-body  overflow-y-auto  p-0">
        <video id="video-player" class="rounded-4" controls width="100%"></video>
        <h2 id="video-title" class="position-absolute top-0  p-3  rounded-4 fs-4 translate-middle-x start-50 text-primary text-center ts-2"></h2>
        <button class="prev-btn p-0" data-way="prev"></button>
        <button class="next-btn p-0" data-way="next"></button>
      </div>
    </div>
  </div>
</div> --}}


@section('content')
  <div class="px-md-5">
    <livewire:video-player :page="'pedagogie'" />
  </div>
@endsection

@section('footer','footer')