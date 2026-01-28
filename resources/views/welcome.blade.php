@extends('layouts.app')

@section('title', 'نورال بوكس | الرئيسية')

@section('content')

<section class="main-banner pt-0">
	<div class="">
		<div class="row laptop align-items-start justify-content-center">
			<div class="col-md-6 p-6 content-banner">
				<div class="banner-text wow fadeInLeft position-relative py-3 py-md-0" data-wow-duration="1000ms">
					<h2 class="mx-none text-center position-relative "><span class="text-purple">{{ __("hero.NeuralBox") }}</span><br>{{__("hero.slogan")}}</h2>
					<p class="mx-none mb-md-5">{{__("hero.desc")}}</p>
					<div class="d-flex gap-md-4 gap-2 justify-content-center justify-content-md-start">
						<a href="#pricing-two" class=" bg-primary  rounded-4 text-white">{{ __("nav.pricing") }}</a>
						<a href="#contact" class=" bg-transparent text-blue  border-primary rounded-4 ">{{ __("nav.about") }}</a>
					</div>
				</div>
			</div>
			<div class=" col-md-6 position-relative">
				<div class="hero_circle blue_circle">
					500+<br>
					طفل مستفيد
				</div>
				<div class="hero_circle pink_circle">
					120+<br>
					أسرة سعيدة
				</div>
				<div class="banner-img d-flex justify-content-start align-items-start wow zoomIn " data-wow-duration="1000ms">
					<img src="{{asset('assets/img/hero/mean.png')}}" alt=""/>
				</div>
			</div>
		</div>
		<div class="row mobile align-items-start justify-content-center">
			<div class="col-md-6 p-6 content-banner">
				<div class="banner-text wow fadeInLeft position-relative py-3 py-md-0" data-wow-duration="1000ms">
					<h2 class="mx-none text-center position-relative "><span class="text-purple">{{ __("hero.NeuralBox") }}</span><br>{{__("hero.slogan")}}</h2>
					<p class="mx-none mb-md-5">{{__("hero.desc")}}</p>
					<div class="d-flex gap-md-4 gap-2 justify-content-center justify-content-md-start">
						<a href="#pricing-two" class=" bg-primary  rounded-4 text-white">{{ __("nav.pricing") }}</a>
						<a href="#contact" class=" bg-transparent text-blue  border-primary rounded-4 ">{{ __("nav.about") }}</a>
					</div>
				</div>
			</div>
			<div class=" col-md-6 position-relative">
				<div class="hero_circle blue_circle">
					500+<br>
					طفل مستفيد
				</div>
				<div class="hero_circle pink_circle">
					120+<br>
					أسرة سعيدة
				</div>
				<div class="banner-img d-flex justify-content-start align-items-start wow zoomIn " data-wow-duration="1000ms">
					<img src="{{asset('assets/img/hero/mean.png')}}" alt=""/>
				</div>
			</div>
		</div>
	</div>
	<div class="gradient-bar"></div>
</section>

<section class="about-us-section">
	<img src="{{ asset('assets/img/bg/about.svg') }}" class="about-bg about-bg-bottom" alt="">
	<div class="container">
		<div class="section-title  text-center">
			<h2>{{ __("about.welcome_to") }}<span class="text-third"> {{ __("hero.NeuralBox") }}</span></h2>
			<p class="mt-md-5 mb-md-4 desc	">{!! trans("about.desc")!!}</p>
		</div>

		<div class="blog-section">
			<div class="blog-posts">
				<div class="blog-post video-post">
					<div class="blog-thumbnail ">
						<a href="#" title="">
							<img src="assets/img/covers/intro.jpg" alt="" class="cover object-position-top">
						</a>
						{{-- <span class="category">{{__("welcome.video_title")}}</span> --}}
						<a data-video-url="{{ route('video-link', ['videoName' => 'intro']) }}"
							data-bs-toggle="modal"
							data-bs-target="#exampledsModal"
							class="video-play play-video overlay-box">
							<img src="assets/img/play.png" alt="">
						</a>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>

<section class="newsletter-section call ">

	<div class="container py-md-5">
		<div class="row text-center justify-content-center">
			<div class="section-title text-center">
				<h2>{!! trans("welcome.call.title1")!!}</h2>
			</div>
		</div>

		<div class="row">
			<div class="col p-0">
				<div class="timeline-steps ">
					<div class="timeline-step">
						<div class="timeline-content">
							<div class="inner-circle"><span>1</span></div>
							{{-- <p class="h6 mt-3 mb-1">1</p> --}}
							<p class="h6 text-muted mb-0 mb-lg-0">{!! trans("welcome.steps.first")!!}</p>
						</div>
					</div>
					<div class="timeline-step">
						<div class="timeline-content">
							<div class="inner-circle"><span>2</span></div>
							{{-- <p class="h6 mt-3 mb-1">2004</p> --}}
							<p class="h6 text-muted mb-0 mb-lg-0">{!! trans("welcome.steps.second")!!}</p>
						</div>
					</div>
					<div class="timeline-step">
						<div class="timeline-content">
							<div class="inner-circle"><span>3</span></div>
							{{-- <p class="h6 mt-3 mb-1">2005</p> --}}
							<p class="h6 text-muted mb-0 mb-lg-0">{!! trans("welcome.steps.third")!!}</p>
						</div>
					</div>
					<div class="timeline-step">
						<div class="timeline-content">
							<div class="inner-circle"><span>4</span></div>
							{{-- <p class="h6 mt-3 mb-1">2010</p> --}}
							<p class="h6 text-muted mb-0 mb-lg-0">{!! trans("welcome.steps.four")!!}</p>
						</div>
					</div>
					<div class="timeline-step mb-0">
						<div class="timeline-content">
							<div class="inner-circle"><span>5</span></div>
							{{-- <p class="h6 mt-3 mb-1">2020</p> --}}
							<p class="h6 text-muted mb-0 mb-lg-0">{!! trans("welcome.steps.five")!!}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="about-page-content overflow-hidden pt-md-4 pb-5 p-0">
	<img src="{{ asset('assets/img/bg/about-content.svg') }}" class="about-bg about-bg-top" alt="">
	<div class="container">
		<div class="abt-page-row">
			<div class="row align-items-center">
				<div class="col-lg-6 col-md-6">
					<div class="section-title">
						<p class="text-black">{!! trans("welcome.coach_abd_founder") !!}</p>
						<h2>{!! trans("welcome.coach_abd") !!}</h2>
						<!-- <a href="classes.html" title="" class="btn-default">Classes <i class="fa fa-long-arrow-alt-right"></i></a> -->
					</div>
					<div class="act-inffo">
						<!-- <span>ABOUT US</span>
						<h2>Our Mission</h2> -->
						<!-- <p>Praesent rhoncus justo erat, sed sollicitudin arcu malesuada vel. Etiam scelerisque justo ut purus luctus ullamcorper. Vivamus vitae elit ligula. Fusce eu rutrum nisl.</p> -->
						<ul>
							<li>{!! trans("welcome.abd_info_1") !!}</li>
							<li>{!! trans("welcome.abd_info_2") !!}</li>
							<li>{!! trans("welcome.abd_info_3") !!}</li>
							<li>{!! trans("welcome.abd_info_4") !!}</li>
							<li>{!! trans("welcome.abd_info_5") !!}</li>
							<li>{!! trans("welcome.abd_info_6") !!}</li>
							<li>{!! trans("welcome.abd_info_7") !!}</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 ">
					<div class="abt-img">
						<img src="assets/img/abt1.png" alt="">
					</div><!--avt-img end-->
				</div>

			</div>
		</div><!--abt-page-row end-->
	</div>
</section>


<div class="blog-section position-relative">
	<img src="{{ asset('assets/img/bg/about-blue.svg') }}" class="about-bg about-bg-top bg-gray" alt="">
	<div class="container">
		<div class="blog-posts">
			<div class="blog-post video-post">
				<div class="blog-thumbnail ">
					<a href="#" >
						<img src="assets/img/covers/storyCover.webp" alt="" class="cover object-position-top">
					</a>
					{{-- <span class="category">{{__("welcome.video_story")}}</span> --}}
					<a data-video-url="{{ route('video-link', ['videoName' => 'story']) }}"
						data-bs-toggle="modal"
						data-bs-target="#exampledsModal" class="video-play play-video overlay-box">
						<img src="assets/img/play.png" alt="">
					</a>
				</div>

			</div>
		</div>
	</div>
</div>

<section>
	<div class="news-block-two" >
		<div class="inner-box">
			<section class="services-section">
				<div class="container">
					<div class="section-title yellow text-white text-center">
						<h2>
							{!!__('transelt.titre1')!!}
						</h2>
					</div>
					<div class="row clearfix">
						<!-- Service Block -->
						<div class="service-block col-lg-3 col-md-4 col-4">
							<div class="inner-box">
								<div class="icon-box">
									<span class="icon"><img src="{{asset('images/icons/fea/9.png')}}" alt="" /></span>
								</div>
								{!!__('transelt.h51')!!}
							</div>
						</div>
						<!-- Service Block -->
						<div class="service-block col-lg-3 col-md-4 col-4">
							<div class="inner-box">
								<div class="icon-box">
									<span class="icon"><img src="{{asset('images/icons/fea/4.png')}}" alt="" /></span>
								</div>
								{!!__('transelt.h52')!!}
							</div>
						</div>
						<!-- Service Block -->
						<div class="service-block col-lg-3 col-md-4 col-4">
							<div class="inner-box">
								<div class="icon-box">
									<span class="icon"><img src="{{asset('images/icons/fea/8.png')}}" alt="" /></span>
								</div>
								{!!__('transelt.h53')!!}
							</div>
						</div>
						<!-- Service Block -->
						<div class="service-block col-lg-3 col-md-4 col-4">
							<div class="inner-box">
								<div class="icon-box">
									<span class="icon"><img src="{{asset('images/icons/fea/5.png')}}" alt="" /></span>
								</div>
								{!!__('transelt.h54')!!}
							</div>
						</div>
						<!-- Service Block -->
						<div class="service-block col-lg-3 col-md-4 col-4">
							<div class="inner-box">
								<div class="icon-box">
									<span class="icon"><img src="{{asset('images/icons/fea/12.png')}}" alt="" /></span>
								</div>
								{!!__('transelt.h55')!!}
							</div>
						</div>

						<!-- Service Block -->
						<div class="service-block col-lg-3 col-md-4 col-4">
							<div class="inner-box">
								<div class="icon-box">
									<span class="icon slide-up"><img src="{{asset('images/icons/fea/1.png')}}" alt="" /></span>
								</div>
								{!!__('transelt.h56')!!}
							</div>
						</div>

						<!-- Service Block -->
						<div class="service-block col-lg-3 col-md-4 col-4">
							<div class="inner-box">
								<div class="icon-box">
									<span class="icon"><img src="{{asset('images/icons/fea/2.png')}}" alt="" /></span>
								</div>
								{!!__('transelt.h57')!!}
							</div>
						</div>

						<!-- Service Block -->
						<div class="service-block col-lg-3 col-md-4 col-4">
							<div class="inner-box">
								<div class="icon-box">
									<span class="icon"><img src="{{asset('images/icons/fea/3.png')}}" alt="" /></span>
								</div>
								{!!__('transelt.h58')!!}
							</div>
						</div>

						<!-- Service Block -->
						<div class="service-block col-lg-3 col-md-4 col-4">
							<div class="inner-box">
								<div class="icon-box">
									<span class="icon"><img src="{{asset('images/icons/fea/6.png')}}" alt="" /></span>
								</div>
								{!!__('transelt.h59')!!}
							</div>
						</div>

						<!-- Service Block -->
						<div class="service-block col-lg-3 col-md-4 col-4">
							<div class="inner-box">
								<div class="icon-box">
									<span class="icon"><img src="{{asset('images/icons/fea/7.png')}}" alt="" /></span>
								</div>
								{!!__('transelt.h510')!!}
							</div>
						</div>

						<!-- Service Block -->
						<div class="service-block col-lg-3 col-md-4 col-4">
							<div class="inner-box">
								<div class="icon-box">
									<span class="icon"><img src="{{asset('images/icons/fea/10.png')}}" alt="" /></span>
								</div>
								{!!__('transelt.h511')!!}
							</div>
						</div>

						<!-- Service Block -->
						<div class="service-block col-lg-3 col-md-4 col-4">
							<div class="inner-box">
								<div class="icon-box">
									<span class="icon"><img src="{{asset('images/icons/fea/11.png')}}" alt="" /></span>
								</div>
								{!!__('transelt.h512')!!}
							</div>
						</div>

					</div>
				</div>
			</section>
		</div>
	</div>
</section>


{{-- <section class="course-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="find-course">
					<div class="sec-title">
						<h2>{{ __("welcome.temoignage.title") }}</h2>
						<!-- <p>{{ __("welcome.temoignage.text") }}</p> -->
						<!-- <h3><img src="assets/img/icon11.png" alt="">{{__("welcome.temoignage.call")}}<a href="´tel:+212539324232"><strong dir="ltr"> +212 539 32 42 32</strong></a></h3> -->
					</div><!--sec-title end-->
					<div class="course-img">
						<img src="assets/img/course-img.png" alt="">
					</div><!--course-img end-->
				</div><!--find-course end-->
			</div>
			<div class="col-lg-6">
				<div class="courses-list">
					<div class="course-card wow fadeInLeft" data-wow-duration="1000ms">
						<!-- <div class="d-flex flex-wrap align-items-center">
							<ul class="course-meta">
								<li>
									<img src="assets/img/icon12.png" alt="">
									29/07/2020
								</li>
								<li>
									11AM to 15PM
								</li>
							</ul>
							<span>FREE</span>
						</div> -->
						<h3>Une très belle expérience pour nos petits je recommande vivement</h3>
						<div class="d-flex flex-wrap">
							<div class="posted-by">
								<img src="https://via.placeholder.com/26x26" alt="">
								<a href="#" title="">Hayat Aït Moulay Hachem</a>
							</div>
							<!-- <span class="locat"><img src="assets/img/loct.png" alt="" />43 castle road 517 district</span> -->
						</div>
					</div>
					<div class="course-card wow fadeInLeft" data-wow-duration="1000ms">

						<h3>Merci bcp Mr Abdessamad pour votre professionnalisme ainsi que votre équipe... Bravo 👏👍👏 et bonne continuation …</h3>
						<div class="d-flex flex-wrap">
							<div class="posted-by">
								<img src="https://via.placeholder.com/26x26" alt="">
								<a href="#" title="">Safaa Imrani</a>
							</div>
							<!-- <span class="locat"><img src="assets/img/loct.png" alt="" />43 castle road 517 district</span> -->
						</div>
					</div>
					<div class="course-card wow fadeInLeft" data-wow-duration="1000ms">
						<h3>تجربة رائعة انصح بها جميع الآباء</h3>
						<div class="d-flex flex-wrap">
							<div class="posted-by">
								<img src="https://via.placeholder.com/26x26" alt="">
								<a href="#" title="">Najat Harti</a>
							</div>
						</div>
					</div>
					<div class="course-card wow fadeInLeft" data-wow-duration="1000ms">

						<h3>I recommend it, Real coaching professionals</h3>
						<div class="d-flex flex-wrap">
							<div class="posted-by">
								<img src="https://via.placeholder.com/26x26" alt="">
								<a href="#" title="">Ziani Ahmed</a>
							</div>
							<!-- <span class="locat"><img src="assets/img/loct.png" alt="" />43 castle road 517 district</span> -->
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</section> --}}

<section class="portfolio-section">
	<div class="auto-container">
		<div class="sec-title right-align">
			{!!__('transelt.p2')!!}
		</div>

		<!-- <img src="{{asset('assets/img/abt-element.png')}}" class=" bg translate-middle -z-10 position-absolute start-0 top-50" alt=""> -->
		<div class="masonry-items-container relative  row  clearfix overflow-hidden ">
			<!-- <img class="cadre absolute top-0 left-0 " src="{{ asset('assets/img/cadre.svg') }}" alt=""> -->
			<!-- Project Block -->

			<!-- <div class="corner top-left"></div>
			<div class="corner top-right"></div>
			<div class="corner bottom-right"></div>
			<div class="dash top"></div>
			<div class="dash bottom"></div>
			<div class="dash left"></div>
			<div class="dash right"></div> -->

			<div class="project-block masonry-item col-lg-6 col-md-12 col-sm-12">
				<div class="inner-box3">
					<div class="image1">
						<img src="images/resource/cover/1.jpg" alt="" />
						<!-- Overlay Box -->
						<a class="icon html5lightbox" data-fancybox="gallery-2" data-caption="" href="https://www.youtube.com/embed/7VR3UoDR3TE">
							<div class="overlay-box">
								<div class="overlay-inner">
									<div class="content">
										<svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
											width="800px" height="800px" viewBox="0 0 163.861 163.861"
											xml:space="preserve">
											<g>
												<path d="M34.857,3.613C20.084-4.861,8.107,2.081,8.107,19.106v125.637c0,17.042,11.977,23.975,26.75,15.509L144.67,97.275
														c14.778-8.477,14.778-22.211,0-30.686L34.857,3.613z" />
											</g>
										</svg>
									</div>
								</div>
							</div>
					</div>
					</a>

				</div>
			</div>

			<!-- Project Block -->
			<div class="project-block masonry-item col-lg-6 col-md-12 col-sm-12 ">
				<div class="inner-box3">
					<div class="image1">
						<img src="images/resource/cover/2.jpg" alt="" />
						<!-- Overlay Box -->
						<a class="icon html5lightbox" data-fancybox="gallery-2" data-caption="" href="https://www.youtube.com/embed/kz1GnP8OOLQ">
							<div class="overlay-box">
								<div class="overlay-inner">
									<div class="content">
										<svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
											width="800px" height="800px" viewBox="0 0 163.861 163.861"
											xml:space="preserve">
											<g>
												<path d="M34.857,3.613C20.084-4.861,8.107,2.081,8.107,19.106v125.637c0,17.042,11.977,23.975,26.75,15.509L144.67,97.275
															c14.778-8.477,14.778-22.211,0-30.686L34.857,3.613z" />
											</g>
										</svg>
									</div>
								</div>
							</div>
					</div>
					</a>
				</div>
			</div>

			<!-- Project Block -->
			<div class="project-block masonry-item col-lg-6 col-md-12 col-sm-12 ">
				<div class="inner-box3">

					<div class="image1">
						<img src="images/resource/cover/4.jpg" alt="" />
						<!-- Overlay Box -->
						<a class="icon html5lightbox html5lightbox" data-fancybox="gallery-2" data-caption="" href="https://www.youtube.com/embed/pCbDVP1D2ug">
							<div class="overlay-box">
								<div class="overlay-inner">
									<div class="content">
										<svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
											width="800px" height="800px" viewBox="0 0 163.861 163.861"
											xml:space="preserve">
											<g>
												<path d="M34.857,3.613C20.084-4.861,8.107,2.081,8.107,19.106v125.637c0,17.042,11.977,23.975,26.75,15.509L144.67,97.275
														c14.778-8.477,14.778-22.211,0-30.686L34.857,3.613z" />
											</g>
										</svg>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>

			<!-- Project Block -->
			<div class="project-block masonry-item col-lg-6 col-md-12 col-sm-12">
				<div class="inner-box3">
					<div class="image1">
						<img src="images/resource/cover/5.jpg" alt="" />
						<!-- Overlay Box -->
						<a class="icon html5lightbox" data-fancybox="gallery-3" data-caption="" href="https://youtu.be/pCbDVP1D2ug?si=mbYCXjSYK0DnNYZF">
							<div class="overlay-box">
								<div class="overlay-inner">
									<div class="content">
										<svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
											width="800px" height="800px" viewBox="0 0 163.861 163.861"
											xml:space="preserve">
											<g>
												<path d="M34.857,3.613C20.084-4.861,8.107,2.081,8.107,19.106v125.637c0,17.042,11.977,23.975,26.75,15.509L144.67,97.275
														c14.778-8.477,14.778-22.211,0-30.686L34.857,3.613z" />
											</g>
										</svg>
									</div>
								</div>
							</div>
					</div>
					</a>
				</div>
			</div>

			<!-- Project Block -->
			<div class="project-block masonry-item col-lg-6 col-md-12 col-sm-12 ">
				<div class="inner-box3">
					<div class="image1">
						<img src="images/resource/cover/3.jpg" alt="" />
						<!-- Overlay Box -->
						<a class="icon html5lightbox" data-fancybox="gallery-2" data-caption="" href="https://www.youtube.com/embed/69dyRI7yhyM">
							<div class="overlay-box">
								<div class="overlay-inner">
									<div class="content">
										<svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
											width="800px" height="800px" viewBox="0 0 163.861 163.861"
											xml:space="preserve">
											<g>
												<path d="M34.857,3.613C20.084-4.861,8.107,2.081,8.107,19.106v125.637c0,17.042,11.977,23.975,26.75,15.509L144.67,97.275
															c14.778-8.477,14.778-22.211,0-30.686L34.857,3.613z" />
											</g>
										</svg>
									</div>
								</div>
							</div>
					</div>
					</a>
				</div>
			</div>

		</div>

	</div>
</section>

{{-- <section id="pricing" class="d-flex min-h-screen ">
	<div class="d-flex w-100  justify-content-space-between">
		<div class="card pricing-card price-red text-center">
			<!-- SVG Wave -->
			<div class="top-wave">
				<svg id="Layer_1" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 379.14 196.29">
					<defs>
						<linearGradient id="red-linear-gradient" x1="189.57" y1="314.16" x2="189.57" y2="412.54" gradientTransform="translate(0 574.12) scale(1 -1)" gradientUnits="userSpaceOnUse">
							<stop offset="0" stop-color="#ffd26f" />
							<stop offset="1" stop-color="#9a262d" />
						</linearGradient>
						<linearGradient id="red-linear-gradient-2" x1="189.56" y1="323.5" x2="189.56" y2="419.7" gradientTransform="translate(0 574.12) scale(1 -1)" gradientUnits="userSpaceOnUse">
							<stop offset="0" stop-color="#d84c07" />
							<stop offset="1" stop-color="#f37335" />
						</linearGradient>
						<linearGradient id="red-linear-gradient-3" y1="393.1" y2="574.12" xlink:href="#linear-gradient-2" />
					</defs>
					<g id="Layer_1-2" data-name="Layer 1">
						<g class="cls-3">
							<g id="Layer_1-3" data-name="Layer 1">
								<g>
									<g class="cls-5">
										<path class="cls-4" d="M346.33,0H32.8C14.68,0,0,14.68,0,32.8v117.53h.47c31.54,0,31.54,45.96,63.08,45.96s31.55-45.96,63.09-45.96,31.56,45.96,63.12,45.96,31.55-45.96,63.1-45.96,31.57,45.96,63.14,45.96,31.57-45.96,63.14-45.96V32.8C379.14,14.69,364.46,0,346.34,0h-.01Z" />
									</g>
									<path class="cls-1" d="M346.33,0H32.8C14.68,0,0,14.68,0,32.8v117.79c47.39,0,47.39,30.64,94.77,30.64s47.37-30.64,94.74-30.64,47.4,30.64,94.81,30.64,47.4-30.64,94.81-30.64V32.8C379.13,14.69,364.45,0,346.33,0Z" />
									<path class="cls-2" d="M346.33,0H32.8C14.68,0,0,14.68,0,32.8v117.53h.47c1.95,0,3.77.18,5.49.51,39.74,2.39,43.43,28.09,83.63,30.18,10.19-13.38,17.68-30.69,37.05-30.69,10.09,0,16.95,4.72,22.65,11.12,9.87-5.9,21.23-10.85,40.23-10.85s30.6,5.05,40.55,11.03c5.73-6.48,12.61-11.29,22.79-11.29,19.38,0,26.87,17.3,37.06,30.68,40.11-2.26,43.7-28.12,84.09-30.2,1.62-.29,3.31-.48,5.12-.48V32.8C379.13,14.69,364.45,0,346.33,0Z" />
								</g>
							</g>
						</g>
					</g>
				</svg>
			</div>



			<div class="card-body ">
				<div>
					<h5 class="card-title text-white fw-bold fs-4 z-1 position-relative">{!! __('transelt.title1')!!}</h5>
					<h2 class="price text-white fw-bold mt-n2 z-1 position-relative" dir="ltr">0 DH</h2>
					{!!__('transelt.ul1')!!}
				</div>


				<a href="{{route('register')}}" class="btn btn-warning fw-bold text-white rounded-pill mt-3 w-100 px-5 justify-content-center">{{ __("auth.register_now") }}</a>
			</div>
		</div>

		<div class="card pricing-card price-blue text-center">
			<div class="top-wave">
				<svg id="Layer_1" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 379.14 196.29">
					<defs>
						<linearGradient id="blue-linear-gradient" x1="189.57" y1="300.38" x2="189.57" y2="398.76" gradientTransform="translate(0 560.34) scale(1 -1)" gradientUnits="userSpaceOnUse">
							<stop offset="0" stop-color="#69c4d8" />
							<stop offset="1" stop-color="#3677ff" />
						</linearGradient>
						<linearGradient id="blue-linear-gradient-2" x1="189.56" y1="309.73" x2="189.56" y2="405.92" xlink:href="#linear-gradient" />
						<linearGradient id="blue-linear-gradient-3" x1="189.56" y1="379.32" x2="189.56" y2="560.34" gradientTransform="translate(0 560.34) scale(1 -1)" gradientUnits="userSpaceOnUse">
							<stop offset="0" stop-color="#5ce0ff" />
							<stop offset="1" stop-color="#69c4d8" />
						</linearGradient>
					</defs>
					<g id="Layer_1-2" data-name="Layer 1">
						<g class="cls-3">
							<g id="Layer_1-3" data-name="Layer 1">
								<g>
									<g class="cls-5">
										<path class="cls-4" d="M346.33,0H32.8C14.68,0,0,14.68,0,32.8v117.53h.47c31.54,0,31.54,45.96,63.08,45.96s31.55-45.96,63.09-45.96,31.56,45.96,63.12,45.96,31.55-45.96,63.1-45.96,31.57,45.96,63.14,45.96,31.57-45.96,63.14-45.96V32.8C379.14,14.69,364.46,0,346.34,0h-.01Z" />
									</g>
									<path class="cls-1" d="M346.33,0H32.8C14.68,0,0,14.68,0,32.8v117.79c47.39,0,47.39,30.64,94.77,30.64s47.37-30.64,94.74-30.64,47.4,30.64,94.81,30.64,47.4-30.64,94.81-30.64V32.8C379.13,14.69,364.45,0,346.33,0Z" />
									<path class="cls-2" d="M346.33,0H32.8C14.68,0,0,14.68,0,32.8v117.53h.47c1.95,0,3.77.18,5.49.51,39.74,2.39,43.43,28.09,83.63,30.18,10.19-13.38,17.68-30.69,37.05-30.69,10.09,0,16.95,4.72,22.65,11.12,9.87-5.9,21.23-10.85,40.23-10.85s30.6,5.05,40.55,11.03c5.73-6.48,12.61-11.29,22.79-11.29,19.38,0,26.87,17.3,37.06,30.68,40.11-2.26,43.7-28.12,84.09-30.2,1.62-.29,3.31-.48,5.12-.48V32.8C379.13,14.69,364.45,0,346.33,0Z" />
								</g>
							</g>
						</g>
					</g>
				</svg>
			</div>



			<div class="card-body ">
				<div>
					<h5 class="card-title text-white fw-bold fs-4 z-1 position-relative">{!! __('transelt.title3')!!}</h5>
					<h2 class="price text-white fw-bold mt-n2 z1 position-relative" dir="ltr">2300 DH</h2>
					{!!__('transelt.ul3')!!}
				</div>

				<a href="{{route('payment.form')}}" class="btn btn-warning fw-bold text-white rounded-pill mt-3 w-100 px-5 justify-content-center">اختر الباقة</a>
			</div>
		</div>

		<div class="card pricing-card price-gold text-center">
			<div class="top-wave">
				<svg id="Layer_1" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 379.14 196.29">
					<defs>

						<linearGradient id="gold-linear-gradient" x1="189.57" y1="368.16" x2="189.57" y2="466.54" gradientTransform="translate(0 628.12) scale(1 -1)" gradientUnits="userSpaceOnUse">
							<stop offset="0" stop-color="#ffd26f" />
							<stop offset="1" stop-color="#f9ea33" />
						</linearGradient>
						<linearGradient id="gold-linear-gradient-2" x1="189.56" y1="427.33" x2="189.56" y2="514.14" gradientTransform="translate(0 628.12) scale(1 -1)" gradientUnits="userSpaceOnUse">
							<stop offset="0" stop-color="#f9c84e" />
							<stop offset="1" stop-color="#f9ff20" />
						</linearGradient>
						<linearGradient id="gold-linear-gradient-3" x1="189.56" y1="447.1" x2="189.56" y2="628.12" gradientTransform="translate(0 628.12) scale(1 -1)" gradientUnits="userSpaceOnUse">
							<stop offset="0" stop-color="#f9c84e" />
							<stop offset="1" stop-color="#f9d920" />
						</linearGradient>
					</defs>
					<g id="Layer_1-2" data-name="Layer 1">
						<g class="cls-3">
							<g id="Layer_1-3" data-name="Layer 1">
								<g>
									<g class="cls-5">
										<path class="cls-4" d="M346.33,0H32.8C14.68,0,0,14.68,0,32.8v117.53h.47c31.54,0,31.54,45.96,63.08,45.96s31.55-45.96,63.09-45.96,31.56,45.96,63.12,45.96,31.55-45.96,63.1-45.96,31.57,45.96,63.14,45.96,31.57-45.96,63.14-45.96V32.8C379.14,14.69,364.46,0,346.34,0h-.01Z" />
									</g>
									<path class="cls-1" d="M346.33,0H32.8C14.68,0,0,14.68,0,32.8v117.79c47.39,0,47.39,30.64,94.77,30.64s47.37-30.64,94.74-30.64,47.4,30.64,94.81,30.64,47.4-30.64,94.81-30.64V32.8C379.13,14.69,364.45,0,346.33,0Z" />
									<path class="cls-2" d="M346.33,0H32.8C14.68,0,0,14.68,0,32.8v117.53h.47c1.95,0,3.77.18,5.49.51,39.74,2.39,43.43,28.09,83.63,30.18,10.19-13.38,17.68-30.69,37.05-30.69,10.09,0,16.95,4.72,22.65,11.12,9.87-5.9,21.23-10.85,40.23-10.85s30.6,5.05,40.55,11.03c5.73-6.48,12.61-11.29,22.79-11.29,19.38,0,26.87,17.3,37.06,30.68,40.11-2.26,43.7-28.12,84.09-30.2,1.62-.29,3.31-.48,5.12-.48V32.8C379.13,14.69,364.45,0,346.33,0Z" />
								</g>
							</g>
						</g>
					</g>
				</svg>
			</div>

			<div class="ribbon">
				<svg id="Layer_2" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 111.84 138.11">
					<defs>
						<style>
							.cls-1 {
								fill: #223b8a;
							}

							.cls-2 {
								fill: #fff;
							}

							.cls-3 {
								isolation: isolate;
							}

							.cls-4 {
								fill: #c6c6c6;
							}
						</style>
					</defs>
					<g id="Layer_1-2" data-name="Layer 1">
						<g class="cls-3">
							<g id="Layer_1-3" data-name="Layer 1">
								<g>
									<polygon class="cls-4" points="101.27 138.11 96.21 132.97 96.26 123.37 100 124.87 101.27 129.1 101.27 138.11" />
									<path class="cls-4" d="M5.76,2.02S1.04,6.01,0,11.09h9.42s4.64-6.13,6.43-5.9l-2.1-3.23-7.99.07h0Z" />
									<path class="cls-2" d="M101.27,138.11c-1.12-24.67-9.4-51.45-25.12-76.34C58.27,33.48,30.84,12.87,5.77,2.02c27.87-8.28,67.16,9.34,89.07,44.01,20.5,32.45,22.23,69.71,6.43,92.08Z" />
									<g>
										<path class="cls-1" d="M58.42,30.17c.07.64-.38,1.2-1.03,1.27-.65.08-1.21-.37-1.27-1.02-.07-.64.38-1.2,1.03-1.27s1.2.38,1.27,1.03h0ZM65.03,21.97l-5.55,6.87-1.31-1.06,5.55-6.87s1.31,1.06,1.31,1.06Z" />
										<path class="cls-1" d="M61.42,31.06l6.66-7.63,1.16,1.01-6.6,7.56c-.77.88-.62,1.81.45,2.74.17.15.1.42-.22.79-.31.36-.55.45-.73.3-1.94-1.69-2.12-3.17-.72-4.77Z" />
										<path class="cls-1" d="M61.63,39.98c-.95-.76.48-2.26,1.28-1.35.92.73-.5,2.23-1.28,1.35ZM66.96,39.43c-.33.34-.57.42-.74.27-.97-.92-1.36-1.83-1.17-2.74-.94.2-1.93-.21-2.98-1.21l.99-1.04c1.07,1.01,1.86.97,3.02-.25l2.4-2.53,1.12,1.06-2.57,2.71-.05.05c-.89.94-.82,1.91.24,2.91.17.16.08.42-.25.77h0Z" />
										<path class="cls-1" d="M70.78,43.43c-.34.33-.59.4-.75.23-.89-.92-1.25-1.83-1.08-2.71-.91.12-1.85-.33-2.84-1.36l1.04-1c.55.57,1.01.83,1.42.8.4-.04.91-.37,1.54-.97l6.89-6.62,1.07,1.11-7.11,6.84c-.93.9-.9,1.87.1,2.92.16.16.07.42-.29.76h0Z" />
										<path class="cls-1" d="M82.4,48.85c-.22,1.06-.84,2-1.83,2.81-.71.58-1.57,1.08-2.59,1.48l-7.96-9.75,1.11-.91,1.08,1.32,9.15-7.47.98,1.19-7.4,6.04c3-.18,5.3.67,6.58,2.23.81.99,1.09,2,.89,3.05h-.01ZM78.31,51.27c.44-.2.84-.46,1.24-.78,1.37-1.12,1.77-2.58.71-3.87-.59-.72-1.51-1.24-2.75-1.54-1.26-.3-2.68-.32-4.3-.06l5.1,6.25Z" />
										<path class="cls-1" d="M85.69,62.26c.12.19-.02.43-.43.69-.4.25-.66.27-.78.08l-1.24-1.96c-1.75.67-3.26.19-4.52-1.41l1.04-.99c1.17,1.33,2.14,1.57,3.6.64l5.2-3.29.83,1.3-4.86,3.08,1.17,1.85h-.01Z" />
										<path class="cls-1" d="M88.04,67.91c-.41.23-.67.24-.78.04-.66-1.16-.77-2.14-.33-2.96-.95-.08-1.77-.75-2.46-1.97l-.08-.14,1.25-.71.09.15c.7,1.24,1.47,1.38,2.92.56l3.04-1.72.76,1.34-3.25,1.84-.06.03c-1.13.64-1.34,1.58-.62,2.85.11.2-.04.43-.47.67v.02ZM93.5,58.41c.47-.27,1.01-.11,1.26.34.27.47.12,1-.35,1.27s-1.01.13-1.28-.34c-.25-.44-.1-.99.38-1.26h-.01ZM96.03,60.99c.25.44.1.97-.37,1.24s-1.01.13-1.26-.31c-.13-.23-.17-.47-.08-.72.18-.79,1.37-.96,1.72-.21h-.01ZM95.97,58.54c.44-.25.99-.1,1.24.34.27.47.11,1.01-.33,1.26-.47.27-1.01.13-1.28-.34-.25-.44-.1-.99.37-1.26Z" />
										<path class="cls-1" d="M95.15,66.35c.32,2.11.17,3.71-.47,4.83s-1.46,1.79-2.77,2.44l-1.46.72-3.22-6.54,1.29-.64,2.56,5.19.42-.21c1.1-.54,1.81-1.32,2.14-2.33.32-1.02.3-2.49-.05-4.43l1.34-.66,6.49,2.33-.47,1.35-5.78-2.06h-.02Z" />
										<path class="cls-1" d="M106.29,77.91l.58,1.43-9.29,3.73c-1.89.76-3.46.09-4.28-1.95l-2.4-5.97,1.33-.54,1.33,3.3,7.61-3.06.58,1.43-7.61,3.06.41,1.01c.54,1.35,1.37,1.72,2.85,1.12l8.9-3.57h0Z" />
										<path class="cls-1" d="M95.29,86.61l12.58-4.18.49,1.46-12.58,4.18-.49-1.46Z" />
									</g>
								</g>
							</g>
						</g>
					</g>
				</svg>
			</div>

			<div class="card-body ">
				<div>
					<h5 class="card-title text-white fw-bold fs-4 z-1 position-relative">{!! __('transelt.title2')!!}</h5>
					<h2 class="price text-white fw-bold mt-n2 z1 position-relative" dir="ltr">3200 DH</h2>
					{!!__('transelt.ul2')!!}
				</div>
				<a href="{{route('payment.form')}}" class="btn btn-warning fw-bold text-white rounded-pill mt-3 w-100 px-5 justify-content-center">اختر الباقة</a>
			</div>
		</div>

	</div>
</section> --}}

<section id="pricing-two" class="d-flex min-h-screen ">
    <div class="container">
        <div class="row g-0 laptop text-center align-items-stretch">
            
            <div class="col-3 d-flex flex-column pt-5">
                <div class="feature-header"></div> <div class="feature-row">محتوى مجاني</div>
                <div class="feature-row">صندوق نيورال بوكس</div>
                <div class="feature-row">تخفيض على الدورات التدريبية</div>
                <div class="feature-row">دليل استعمال نيورال بوكس</div>
                <div class="feature-row">خصم على استشارات مواكبة</div>
                <div class="feature-row">تقييم ومتابعة لتطور الطفل</div>
                <div class="feature-row">المحتوى البيداغوجي</div>
                <div class="feature-row">كتب إلكترونية</div>
                <div class="feature-row">مجتمع نيورال بوكس على التلغرام</div>
                <div class="feature-row border-0">مراجع لفهم مشاكل واضطرابات التعلم</div>
            </div>

            <div class="col-3 d-flex flex-column pt-5">
                <div class="package-header mb-4">
                    <h3>باقة الانطلاق</h3>
                    <h2>0 DH</h2>
                </div>
                <div class="feature-row"><i class="fas fa-check"></i></div>
                <div class="feature-row text-warning"><i class="fas fa-times"></i></div>
                <div class="feature-row text-warning"><i class="fas fa-times"></i></div>
                <div class="feature-row text-warning"><i class="fas fa-times"></i></div>
                <div class="feature-row text-warning"><i class="fas fa-times"></i></div>
                <div class="feature-row text-warning"><i class="fas fa-times"></i></div>
                <div class="feature-row text-warning"><i class="fas fa-times"></i></div>
                <div class="feature-row"><i class="fas fa-check"></i></div>
                <div class="feature-row"><i class="fas fa-check"></i></div>
                <div class="feature-row text-warning border-0"><i class="fas fa-times"></i></div>
                <div class="mt-auto pb-4">
                    <a href="#" class="btn btn-light rounded-pill px-4">أنشئ حسابك الآن</a>
                </div>
            </div>

            <div class="col-3 d-flex flex-column pt-5">
                <div class="package-header mb-4">
                    <h3>باقة نيورال بوكس</h3>
                    <h2>2300 DH</h2>
                </div>
                <div class="feature-row"><i class="fas fa-check"></i></div>
                <div class="feature-row"><i class="fas fa-check"></i></div>
                <div class="feature-row"><i class="fas fa-check"></i></div>
                <div class="feature-row"><i class="fas fa-check"></i></div>
                <div class="feature-row"><i class="fas fa-check"></i></div>
                <div class="feature-row text-warning"><i class="fas fa-times"></i></div>
                <div class="feature-row text-warning"><i class="fas fa-times"></i></div>
                <div class="feature-row"><i class="fas fa-check"></i></div>
                <div class="feature-row"><i class="fas fa-check"></i></div>
                <div class="feature-row text-warning border-0"><i class="fas fa-times"></i></div>
                <div class="mt-auto pb-4">
                    <a href="#" class="btn btn-light rounded-pill px-4">اختر الباقة</a>
                </div>
            </div>

            <div class="col-3 d-flex flex-column pt-5 highlighted-col">
                <div class="package-header mb-4">
                    <h3>باقة نيورال بوكس</h3>
                    <h2>3200 DH</h2>
                </div>
                <div class="feature-row"><i class="fas fa-check"></i></div>
                <div class="feature-row"><i class="fas fa-check"></i></div>
                <div class="feature-row"><i class="fas fa-check"></i></div>
                <div class="feature-row"><i class="fas fa-check"></i></div>
                <div class="feature-row"><i class="fas fa-check"></i></div>
                <div class="feature-row"><i class="fas fa-check"></i></div>
                <div class="feature-row"><i class="fas fa-check"></i></div>
                <div class="feature-row"><i class="fas fa-check"></i></div>
                <div class="feature-row"><i class="fas fa-check"></i></div>
                <div class="feature-row border-0"><i class="fas fa-check"></i></div>
                <div class="mt-auto pb-4">
                    <a href="#" class="btn btn-magenta rounded-pill px-4">اختر الباقة</a>
                </div>
            </div>

        </div>
        {{-- <div class="row g-0 mobile text-center align-items-stretch">
			<div class="card">
				<h5 class="card-header">Featured</h5>
				<div class="card-body">
					<h5 class="card-title">Special title treatment</h5>
					<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
				</div>
			</div>
        </div> --}}
    </div>
</section>

<section class="partners">
	<div class="container">
		<h6 class="sec-title">{{ __('transelt.our_partners') }}</h6>
		<div class="row">
			<div class="col partner-logo-container"> <img class="partner-logo" src="{{ asset('assets/img/partners/insic.png') }}" alt="insic logo"></div>
			<div class="col partner-logo-container"> <img class="partner-logo" src="{{ asset('assets/img/partners/LC.png') }}" alt="Leaders Camp logo"></div>
			<div class="col partner-logo-container"> <img class="partner-logo" src="{{ asset('assets/img/partners/taqasom.png') }}" alt="Taqasom logo"></div>
			<div class="col partner-logo-container"> <img class="partner-logo" src="{{ asset('assets/img/partners/abd.png') }}" alt="Abdssamad logo"></div>
			<div class="col partner-logo-container"> <img class="partner-logo" src="{{ asset('assets/img/partners/conceptify.png') }}" alt="Conceptify logo"></div>
		</div>
	</div>
</section>

<section id="contact" class="main_contact pt-md-5 pb-md-5">
	<div class="container">
		<div class="row gap-4 flex-column flex-md-row justify-content-center">
			<div class="col-md-5 order-2 order-md-1 col-12 contact-container">
				<div class="d-flex gap-3 p-3 info-item" ><i class="fas fa-phone-flip"></i><h6>{{ __('contact.fix_number') }} 	| 	{{ __('contact.phone_number') }}</h6></div>
				{{-- <div class="d-flex gap-3 p-3 info-item" ><i class="fas fa-phone-flip"></i><h6>{{ __('contact.phone_number') }}</h6></div> --}}
				<div class="d-flex gap-3 p-3 info-item" ><i class="fas fa-location-dot"></i><h6>{{ __('contact.addresseDesc') }}</h6></div>
				<div class="map-container">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7445.99017683554!2d-5.848830065145886!3d35.76088448176391!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0b87629bd97a35%3A0xa3d8d404e9cd8c3e!2sInstitut%20de%20Neurosciences%20et%20Coaching%20-%20INSIC!5e0!3m2!1sfr!2sma!4v1769084833075!5m2!1sfr!2sma"  style="border:0;" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>
			</div>
			<div class="col-md-6 order-1 order-md-2 col-12 form-container">
				<h6 class="sec-title">{{ __('transelt.happy_to_contact') }}</h6>
				@php
					$topic = [
						['id' => 'golden_pack', 'title' => __('transelt.golden_pack')],
						['id' => 'basic_pack', 'title' => __('transelt.basic_pack')],
						['id' => 'neuralbox_pack', 'title' => __('transelt.neuralbox_pack')],
						['id' => 'our_formations', 'title' => __('transelt.our_formations')],
						['id' => 'other', 'title' => __('transelt.other')],
					];
				@endphp
					<form action="{{ route('contact.send') }}" method="POST">
    					@csrf
					<div class="rating-group">
						@foreach($topic as $t)
							<div class="">
								<input type="radio" name="topic" value="{{ $t['id'] }}" id="{{ $t['id'] }}" {{ $t['id'] == "other" ? "checked" :"" }}>
								<label class="radio-label" for="{{ $t['id'] }}">{{ __('transelt.'.$t['id']) }}</label>
							</div>
						@endforeach
					</div>

					<div>
						<input type="text" placeholder="{{ __('contact.full_name') }}" name="full_name" id="full_name" />
					</div>
					<div>
						<input type="email" placeholder="{{ __('contact.email') }}" name="email" id="email" />
					</div>
					<div>
						<textarea placeholder="{{ __('contact.message') }}" name="message" id="message" ></textarea>
					</div>
					<button type="submit" class="bg-purple text-white float-start" >{{ __('contact.send') }} <i class="fas fa-paper-plane"></i></button>
				</form>
				@if(session('success'))
					<div class="alert alert-success">{{ session('success') }}</div>
				@endif
			</div>
		</div>
	</div>
</section>




{{-- <section class="page-content mt-md-5 pt-md-2 pb-0 mt-0 pt-1">
	<div class="container pt-md-5">
		<div class="mdp-contact">
			<div class="row">
				<div class="col-lg-7 gap-3 col-md-7">
					<div class="sec-title comment-area">
						<h2 class="mb-md-5">{{ __("contact.contact_us")}}</h2>
						<form id="contact-form" method="post" action="#">
							<div class="response"></div>
							<div class="row">
								<div class="col-md-6 col-6">
									<div class="form-group">
										<input type="text" name="name" class="name" placeholder="{{ __('contact.full_name') }}" required>
									</div><!--form-group end-->
								</div>
								<div class="col-md-6 col-6">
									<div class="form-group">
										<input type="email" name="email" class="email" placeholder="{{ __('contact.email') }}" required>
									</div><!--form-group end-->
								</div>
								<div class="col-lg-12">
									<div class="form-group">
										<textarea name="message" placeholder="{{ __('contact.message') }}"></textarea>
									</div><!--form-group end-->
								</div>
								<div class="col-lg-12">
									<div class="form-submit">
										<button type="button" id="submit" class="btn-default">{{ __("contact.send") }} <i class="fa fa-long-arrow-alt-right"></i></button>
									</div><!--form-submit end-->
								</div>
								<div class="mdp-map">
									<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3366.376379496629!2d-5.8426422510888365!3d35.76103609613877!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0b87629bd97a35%3A0xa3d8d404e9cd8c3e!2sInstitut%20de%20Neurosciences%20et%20Coaching%20-%20INSIC!5e0!3m2!1sfr!2sma!4v1749116315210!5m2!1sfr!2sma"
										width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
								</div>
							</div>
						</form>
					</div><!--comment-area end-->
				</div>
				<div class="col-lg-5 col-md-5">
					<div class="mdp-our-contacts">
						<!-- <h3>{{ __('contact.we_are_here') }}</h3> -->
						<ul>
							<li>
								<div class="contact-info-container d-flex flex-md-wrap flex-row">
									<div class="icon-v">
										<img src="assets/img/icon15.png" alt="">
									</div>
									<div class="dd-cont">
										<h4>{{ __('contact.phone') }}</h4>
										<div class="d-flex">
											<span dir="ltr"><a target="_blank" href="tel:212539324232">+212 539 32 42 32</a></span>
											<div class="vr mx-2"></div>
											<!-- <span dir="ltr"><a target="_blank" href="tel:212661553765">+212 661 55 37 65</a></span>
											<div class="vr mx-2"></div> -->
											<span dir="ltr"><a target="_blank" href="https://wa.me/212667325757">+212 667 32 57 57</a></span>
										</div>
									</div>
								</div>
							</li>
							<li>
								<div class="contact-info-container d-flex flex-md-wrap flex-row">
									<div class="icon-v">
										<img src="assets/img/icon16.png" alt="">
									</div>
									<div class="dd-cont">
										<h4>{{ __('contact.work_time') }}</h4>
										<span>{{ __('contact.work_time_det') }}</span>
									</div>
								</div>
							</li>
							<li>
								<div class="contact-info-container d-flex flex-md-wrap flex-row">
									<div class="icon-v">
										<img src="assets/img/icon17.png" alt="">
									</div>
									<div class="dd-cont">
										<h4>{{ __('contact.addresse') }}</h4>
										<span>{{ __('contact.addresseDesc') }}</span>
									</div>
								</div>
							</li>
							<li>
								<div>
									<ul class="social-links">
										<li><a href="#" title=""><i class="fab fa-facebook-f"></i></a></li>
										<li>
											<a href="https://www.youtube.com/@TAQASOM.Podcast" title="">
												<i class="fab fa-youtube"></i>
											</a>
										</li>
										<li><a href="https://www.instagram.com/neuralbox/" title="Neuralbox Instagram account"><i class="fab fa-instagram"></i></a></li>
									</ul>
								</div>
							</li>
						</ul>
					</div><!--mdp-our-contacts end-->
				</div>
			</div>
		</div><!--mdp-contact end-->
	</div>
</section> --}}

@endsection
@section('videoModal','without')
@section('footer','footer')