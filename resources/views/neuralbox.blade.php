 @extends('layouts.app')

 @section('title', 'نيورال بوكس | دليل نيورال بوكس')

 @section('background', 'url(images/peda/1.png)')

 @section('content')


 <section class="page-content pt-5 pb-0 peda">
   <div class="container">
     <div class="teacher-single-page mb-0">
       <div class="row justify-content-between">
         <div class="col-lg-6">
           <div class="teacher-content">

             <p>{!! trans("neuralbox.desc") !!}</p>
        
             <button class=" btn-default text-xl ps-4 py-2 h-auto ">{{__("neuralbox.watch_now")}}<i class="fa fa-long-arrow-alt-right"></i></button>

           </div>
         </div>
         <div class="col-lg-5 justify-start">
           <div class="teacher-coly overflow-hidden">
             <a href="{{ route('video-link', ['filename' => 'videos/why_neural.mp4']) }}" class="html5lightbox overlay-box" poster="images/peda/1.png">

               <img src="{{ asset('assets/img/covers/why_neural.jpg') }}" class="w-100 h-100" alt="">
             </a>
             <ul class="social-icons">
               <li><a href="#" title=""><i class="fa fa-clock"></i></a>
                 <h3>{!! trans('neuralbox.duree_') !!}</h3>
               </li>
               <li><a href="#" title=""><i class="fa fa-language"></i></a>
                 <h3>{!! trans('neuralbox.arabe') !!}</h3>
               </li>
               <li><a href="#" title=""><i class="fa fa-book"></i></a>
                 <h3>{!! trans('neuralbox.videos') !!}</h3>
               </li>
             </ul>
           </div>
         </div>

       </div>
     </div>

   </div>
 </section>

 <div class="max-w-full videos-slide  position-relative">
   <p class="title lead display-6 ">{{__("neuralbox.slide-title")}}</p>
   <div class="slick-carousel z-2">
     @foreach($ressourcesGratuites as $ressource)
     <a href="{{ url('/video-url/'. $ressource->video_url) }}" class="slide-card html5lightbox overlay-box">
       <div class="image-wrapper">
         <img src="{{ route('secure.file',['id' => $ressource->id] ) }}" alt="{{__('hero.NeuralBox') ." ". $ressource->titre}}">
         <div class="overlay">
           <h5 class="title p-0">{{ $ressource->titre }}</h5>
           <p class="desc">{{ $ressource->description }}</p>
         </div>
       </div>
     </a>

     @endforeach
     @foreach($ressourcesPremium as $ressource)
     @php

     $subscribed = false;
     if(Auth::check())
     $subscribed = Auth::check() && Auth::user()->subscription_type;
     $linkAttrs = [
     'class' => $subscribed ? 'slide-card html5lightbox overlay-box' : 'slide-card disabled-link',
     ];
     @endphp

     <a
       @if($subscribed)
       href="{{ url('/video-url/'. $ressource->video_url) }}"
       @else
       href="javascript:void(0)" onclick="showPopup()"
       @endif
       @foreach($linkAttrs as $attr=> $value)
       {{ $attr }}="{{ $value }}"
       @endforeach
       >
       <div class="image-wrapper">
         @if(!($subscribed))
         <svg id="Layer_2" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 224.37 224.24">
  <g id="Layer_2-2" data-name="Layer 2">
    <g id="Layer_1-2" data-name="Layer 1-2">
      <g>
        <path d="M27.64,38.24c-61.18,69.85-14.4,180.55,77.55,185.92,4.62.27,9.38-.2,14.02,0l11.48-1.44c48.04-7.89,86.34-47.36,92.74-95.64.35-2.63.26-5.51.94-8.04v-14.01C218.57,5.92,93.56-37,27.64,38.24ZM159.95,156.92c-.7,7.84-6.15,12.38-13.78,12.95-21.91,1.64-45.82-1.28-67.95,0-7.83-.37-13.18-5.52-13.8-13.36-1.1-14,.76-29.54.14-43.69.71-5.93,4.62-10.22,10.34-11.79.44-6.81-.39-14,.04-20.77,2.19-35.11,46.61-48.69,67.41-20.05,9.21,12.69,6.83,25.99,7.15,40.82,6.07,1.55,9.9,6.34,10.45,12.55-.9,13.99,1.24,29.54,0,43.34Z"/>
        <path d="M130.16,81.16v19.49h-35.93v-19.05c0-23.04,35.93-22.5,35.93-.44Z"/>
        <path d="M117.9,142.48v12.92h-11.4v-12.92c-9.65-5.23-6.82-20.73,4.15-21.7,13.14-1.17,18.13,14.91,7.25,21.7Z"/>
      </g>
    </g>
  </g>
</svg>
         @endif
         <img src="{{ route('secure.file',['id' => $ressource->id] ) }}" alt="{{__('hero.NeuralBox') ." ". $ressource->titre}}">
         <div class="overlay">
           <h5 class="title p-0">{{ $ressource->titre }}</h5>
           <p class="desc">{{ $ressource->description }}</p>
         </div>
       </div>
     </a>


     @endforeach


   </div>
 </div>

 @endsection
 @section('footer','footer')