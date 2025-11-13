 @extends('layouts.app')

 @section('title', 'نيورال بوكس | دليل نيورال بوكس')

 @section('background', 'url(images/peda/1.png)')


 @php
 $subscribed = false;
 if(Auth::check())
 $subscribed = Auth::check() && (Auth::user()->subscription_type || Auth::user()->is_admin);
 $linkAttrs = [
 'class' => $subscribed ? 'play-video private fs-4 text-white' : ' disabled-link opacity-50 fs-4 text-white',
 ];
 @endphp
 @section('content')

 <div class="peda-page">

   <section class="page-content pt-5 pb-0 peda">
     <div class="container">
       <div class="teacher-single-page mb-0">
         <div class="row justify-content-between ">
           <div class="col-lg-5 ">
             <div class="teacher-content vh-66 overflow-y-auto">

               <p>{!! trans("neuralbox.desc") !!}</p>

               {{-- <button class=" btn-default text-xl ps-4 py-2 h-auto ">{{__("neuralbox.watch_now")}}<i class="fa fa-long-arrow-alt-right"></i></button> --}}

             </div>
           </div>
           <div class="col-lg-7  justify-start">
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
               {{-- <ul class="social-icons">
                <li><a href="#" title=""><i class="fa fa-clock"></i></a>
                  <h3>{!! trans('neuralbox.duree_') !!}</h3>
                </li>
                <li><a href="#" title=""><i class="fa fa-language"></i></a>
                  <h3>{!! trans('neuralbox.arabe') !!}</h3>
                </li>
                <li><a href="#" title=""><i class="fa fa-book"></i></a>
                  <h3>{!! trans('neuralbox.videos') !!}</h3>
                </li>
              </ul> --}}
             </div>
           </div>
         </div>
       </div>
     </div>
   </section>

   <div class="max-w-full videos-slide position-relative">

     <ul class="list-unstyled mb-0 categories-list">
       @foreach($ressources as $ressource)
       <li class="ps-4  mx-4 mb-5 border-b-2">
         @if ($ressource->visibilite == 'tous')
         <a href="#"
           class="play-video fs-4 text-white"
           data-bs-toggle="modal"
           data-bs-target="#exampledsModal"
           data-video-url="{{ route('video-link', ['videoName' => $ressource->video_url]) }}"
           data-video-id="{{$ressource->encrypted_id}}"
           data-video-title="{{$ressource->title}}">
           {{ $ressource->titre }}
         </a>
         @else
         <a
           @if($subscribed)
           data-video-url="{{ route('video-link', ['videoName' => $ressource->video_url]) }}"
           data-bs-toggle="modal"
           data-bs-target="#exampledsModal"
           data-video-id="{{$ressource->encrypted_id}}"
           data-video-title="{{$ressource->title}}"
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
         <!-- <p class="text-white px-5 fs-6">
          {{-- {{ $ressource->description }} --}}
        </p> -->
       </li>


       </li>
       @endforeach
     </ul>

   </div>
 </div>

 @section('scripts')
 <script>
   document.addEventListener('DOMContentLoaded', function() {
     const $spinner = $("#global-spinner");

     // 1. Reference the Bootstrap Modal and its components
     const videoModalElement = document.getElementById('exampledsModal');
     const rateform = document.getElementById('rateForm');
     // Ensure the Bootstrap Modal component is initialized
     const videoModal = new bootstrap.Modal(videoModalElement);

     // The video player is inside the modal
     const videoPlayer = document.getElementById('video-player');

     let hls = null; // Variable to hold the Hls.js instance

     // 2. Attach click listener to all video links
     // NOTE: The element needs the class 'play-video' and data-video-url
     function loadVideo(videoData) {
       console.log(videoData);

       const videoSrc = videoData.video_url;
       currentVideoId = videoData.id;


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

     function checkSubmitted(ressourceid) {
       /* stylelint-disable-next-line */
       if ({{Auth::check()}}) {
         $("#ressource_id").val(ressourceid);
        console.log(ressourceid);
        
         $.ajax({
           url: "{{ route('rates.isAlreadySubmitted') }}",
           method: 'POST',
           data: {
             'ressource_id': ressourceid,
             '_token': '{{ csrf_token() }}'
           }, // No need for _token here!
           success: function(response) {
             if (response.isSubmittedBefore)
               $("#rateForm").addClass("d-none");
             else $("#rateForm").removeClass("d-none");
           },
           error: function(xhr) {
             console.error("AJAX Error:", xhr.responseText);
           }
         });
       }
     }

     document.querySelectorAll('.play-video').forEach(function(el) {
       el.addEventListener('click', function(e) {
         e.preventDefault();
         let id = this.getAttribute('data-video-id');

         checkSubmitted(id)




         const videoData = {
           id: id,
           video_url: this.getAttribute('data-video-url'),
           title: this.getAttribute('data-video-title') || '',
         };
         if (!videoData.id || !videoData.video_url) return;
         loadVideo(videoData);
       });
     });

     // 6. Stop video playback when the modal is closed (Crucial for UX)
     videoModalElement.addEventListener('hidden.bs.modal', function() {
       videoPlayer.pause();
       videoPlayer.currentTime = 0; // Reset video to the beginning
       // Remove source to prevent background buffering/playback
       videoPlayer.removeAttribute('src');

       // Destroy HLS instance if it exists
       if (hls) {
         hls.destroy();
         hls = null;
       }
     });


     $('#rateForm').on('submit', function(e) {
       e.preventDefault();

       let $form = $(this);
       let $messages = $('#form-messages');
       $messages.html('');

       $.ajax({
         url: "{{ route('rates.store') }}",
         method: 'POST',
         data: $form.serialize(),
         beforeSend: function() {
           $form.find('button[type=submit]').prop('disabled', true).text('...جاري الإرسال');
         },
         success: function(response) {
           $messages.html(`
                    <div class="alert alert-success text-center">{{__('${response.message}')}}</div>
                `);
           $form.trigger('reset');
           $("#ressource_id").val(response.videoData.id);
            
            checkSubmitted(response.videoData.id)
           loadVideo(response.videoData);

         },
         error: function(xhr) {
           if (xhr.status === 422) {
             let errors = xhr.responseJSON.errors;
             let list = '<ul class="mb-0">';
             Object.keys(errors).forEach(function(key) {
               list += `<li>${errors[key][0]}</li>`;
             });
             list += '</ul>';
             $messages.html(`<div class="alert alert-danger">${list}</div>`);
           } else {
             $messages.html(`<div class="alert alert-danger">حدث خطأ غير متوقع.</div>`);
           }
         },
         complete: function() {
           $form.find('button[type=submit]').prop('disabled', false).text('إرسال التقييم');
         }
       });
     });
   });
 </script>
 @endsection
 @endsection

 <div class="modal fade overflow-hidden video-learning-modal vh-100" id="exampledsModal" tabindex="1" aria-labelledby="exampledsModalLabel" aria-hidden="true">
   <div class="modal-dialog m-auto   modal-xl  modal-dialog-centered">
     <div class="modal-content vh-100 bg-transparent flex-row-reverse   border-0 shadow-lg">
       <div class="modal-body  overflow-y-auto  p-0">
         <video id="video-player" controls width="100%"></video>
         @auth

         <form id="rateForm" class="p-4 bg-light   shadow-sm">
           @csrf
           <input type="hidden" id="ressource_id" name="signed_ressource_id" value="">

           <div id="form-messages" class="mb-3"></div>

           <h5 class="mb-3 fw-bold text-center">المرجو وضع علامة في الخانة الملائمة لتقييمكم:</h5>

           <div class="table-responsive mb-4">
             <table class="table table-bordered align-middle text-center">
               <thead class="table-secondary">
                 <tr>
                   <th>التقييم</th>
                   <th>درجة الرضا</th>
                   <th>التقييم</th>
                   <th>درجة الرضا</th>
                 </tr>
               </thead>
               <tbody>
                 <tr>
                   <td>تم احترام خطوات دليل الاستعمال</td>
                   <td>
                     @foreach(['fully','partially','not_at_all'] as $val)
                     <div class="form-check form-check-inline">
                       <input class="form-check-input" type="radio" required name="manual_steps_respect" value="{{ $val }}">
                       <label class="form-check-label">{{ __('neuralbox.'.$val) }}</label>
                     </div>
                     @endforeach
                   </td>
                   <td>تقوية التركيز والانتباه والذاكرة</td>
                   <td>
                     @foreach(['good','average','weak'] as $val)
                     <div class="form-check form-check-inline">
                       <input class="form-check-input" type="radio" required name="focus_and_memory" value="{{ $val }}">
                       <label class="form-check-label">{{ __('neuralbox.'.$val) }}</label>
                     </div>
                     @endforeach
                   </td>
                 </tr>

                 <tr>
                   <td>انخراط أفراد الأسرة</td>
                   <td>
                     @foreach(['good','average','weak'] as $val)
                     <div class="form-check form-check-inline">
                       <input class="form-check-input" type="radio" required name="family_involvement" value="{{ $val }}">
                       <label class="form-check-label">{{ __('neuralbox.'.$val) }}</label>
                     </div>
                     @endforeach
                   </td>
                   <td>الثبات الحركي والانفعالي</td>
                   <td>
                     @foreach(['good','average','weak'] as $val)
                     <div class="form-check form-check-inline">
                       <input class="form-check-input" type="radio" required name="motor_and_emotional_stability" value="{{ $val }}">
                       <label class="form-check-label">{{ __('neuralbox.'.$val) }}</label>
                     </div>
                     @endforeach
                   </td>
                 </tr>

                 <tr>
                   <td>تحقيق المتعة والترفيه</td>
                   <td>
                     @foreach(['good','average','weak'] as $val)
                     <div class="form-check form-check-inline">
                       <input class="form-check-input" type="radio" required name="enjoyment" value="{{ $val }}">
                       <label class="form-check-label">{{ __('neuralbox.'.$val) }}</label>
                     </div>
                     @endforeach
                   </td>
                   <td>تجنب الإدمان الإلكتروني</td>
                   <td>
                     @foreach(['fully','partially','not_at_all'] as $val)
                     <div class="form-check form-check-inline">
                       <input class="form-check-input" type="radio" required name="digital_addiction_avoidance" value="{{ $val }}">
                       <label class="form-check-label">{{ __('neuralbox.'.$val) }}</label>
                     </div>
                     @endforeach
                   </td>
                 </tr>

                 <tr>
                   <td>تحقيق التحدي والمثابرة</td>
                   <td>
                     @foreach(['good','average','weak'] as $val)
                     <div class="form-check form-check-inline">
                       <input class="form-check-input" type="radio" required name="challenge_and_persistence" value="{{ $val }}">
                       <label class="form-check-label">{{ __('neuralbox.'.$val) }}</label>
                     </div>
                     @endforeach
                   </td>
                   <td>تم استعمال الوثائق المرفقة</td>
                   <td>
                     @foreach(['fully','partially','not_at_all'] as $val)
                     <div class="form-check form-check-inline">
                       <input class="form-check-input" type="radio" required name="attached_docs_usage" value="{{ $val }}">
                       <label class="form-check-label">{{ __('neuralbox.'.$val) }}</label>
                     </div>
                     @endforeach
                   </td>
                 </tr>
               </tbody>
             </table>
           </div>

           <div class="mb-3">
             <label class="form-label fw-bold">إيجابيات اللعبة:</label>
             <textarea class="form-control" name="game_strengths" rows="3"></textarea>
           </div>

           <div class="mb-3">
             <label class="form-label fw-bold">النتائج الملحوظة:</label>
             <textarea class="form-control" name="observed_results" rows="3"></textarea>
           </div>

           <div class="mb-3">
             <label class="form-label fw-bold">الصعوبات:</label>
             <textarea class="form-control" name="difficulties" rows="3"></textarea>
           </div>

           <div class="mb-3">
             <label class="form-label fw-bold">إضافات وملاحظات عامة:</label>
             <textarea class="form-control" name="general_notes" rows="3"></textarea>
           </div>

           <div class="text-center mt-4">
             <button type="submit" class="btn btn-primary px-5">إرسال التقييم</button>
           </div>
         </form>
         @endauth
       </div>
     </div>
   </div>
 </div>

 @section('footer','footer')