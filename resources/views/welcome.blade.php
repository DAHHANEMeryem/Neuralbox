@extends('layouts.app')

@section('title', 'نورال بوكس | الرئيسية')

@section('content')

<section class="main-banner pt-0">
	<div class="container">
		<div class="row align-items-start">
			<div class="col-lg-7 col-md-7 pt-5">
				<div class="banner-text wow fadeInLeft position-relative" data-wow-duration="1000ms">
					<h2><span>{{ __("hero.NeuralBox") }}</span><br>{{__("hero.slogan")}}</h2>
					<p>{{__("hero.desc")}}</p>
					<!-- <form class="search-form">
						<input type="text" name="search" placeholder="Search Class">
						<button><i class="fa fa-search"></i></button>
					</form> -->
				</div>
				<div class="box">
					<img src="assets/img/Box/Box.png" class="box" alt="">
				</div>
			</div>
			<div class="col-lg-5 col-md-5">
				<div class="hero_circle blue_circle">
					500+<br>
					طفل مستفيد
				</div>
				<div class="hero_circle pink_circle">
					120+<br>
					أسرة سعيدة
				</div>
				<div class="banner-img wow zoomIn" data-wow-duration="1000ms">
					<img src="assets/img/banner-img.png" alt="">
				</div><!--banner-img end-->
				<div class="elements-bg wow zoomIn" data-wow-duration="1000ms"></div>
			</div>
		</div>
	</div>
</section><!--main-banner end-->
<!-- <h2 class="main-title">{{ __("hero.NeuralBox") }}</h2> -->

</div>

<section class="about-us-section">
	<div class="container">
		<div class="section-title  text-center">
			<h2>{{ __("about.welcome_to") }}<span> {{ __("hero.NeuralBox") }}</span></h2>
			<p class="mt-5 mb-4">{!! trans("about.desc")!!}</p>
		</div><!--section-title end-->
		<div class="about-sec">
			<div class="container">
				<div class="row">
					<!-- <div class="col-lg-3 col-md-6 col-sm-6">
						<div class="abt-col wow fadeInUp" data-wow-duration="1000ms">
							<img src="assets/img/icon5.png" alt="">
							<h3>{{ __("welcome.values.inside_change") }}</h3>
						</div>
					</div> -->
					<div class="col-lg-4 col-md-6 col-sm-6">
						<div class="abt-col wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="200ms">
							<img src="assets/img/about/1.png" alt="">
							<h3>{{ __("welcome.values.empowering") }}</h3>
							<!-- <p>Pelleneget tespharetra que fringilla egugue id eget pharetra</p> -->
						</div><!--abt-col end-->
					</div>
					<div class="col-lg-4 col-md-6 col-sm-6">
						<div class="abt-col wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="400ms">
							<img src="assets/img/about/2.png" alt="">
							<h3>{{ __("welcome.values.integrating") }}</h3>
							<!-- <p>Etiam risus neque, volutpat vel laoreet a, finibus volutpat non</p> -->
						</div><!--abt-col end-->
					</div>
					<div class="col-lg-4 col-md-6 col-sm-6">
						<div class="abt-col wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="600ms">
							<img src="assets/img/about/3.png" alt="">
							<h3>{{ __("welcome.values.creativity") }}</h3>
							<!-- <p>Mauris nec mi fequis giat, cursus tortor nec, pharetra tellus</p> -->
						</div><!--abt-col end-->
					</div>
				</div>
			</div>
		</div><!--about-rw end-->

		<div class="blog-section">
			<div class="blog-posts">
				<div class="blog-post video-post">
					<div class="blog-thumbnail ">
						<a href="#" title="">
							<img src="assets/img/covers/intro.jpg" alt="" class="cover">
						</a>
						<span class="category">{{__("welcome.video_title")}}</span>
						<a href="{{ url('/video-url/videos/intro.mp4') }}" class="video-play html5lightbox overlay-box">
							<img src="assets/img/play.png" alt="">
						</a>
					</div>

				</div>
			</div>
		</div>
		<!-- <div class="abt-img">
			<ul class="masonary" style="position: relative; height: 588px;">
				<li class="width1 wow zoomIn" data-wow-duration="1000ms" style="visibility: visible; animation-duration: 1000ms; animation-name: jb; position: absolute; left: 0px; top: 0px;"><a href="assets/img/gallery1.jpg" data-group="set1" title="" class="html5lightbox"><img src="assets/img/gallery1.jpg" alt=""></a></li>
				<li class="width2 wow zoomIn" data-wow-duration="1000ms" style="visibility: visible; animation-duration: 1000ms; animation-name: jb; position: absolute; left: 199px; top: 0px;"><a href="assets/img/gallery2.jpg" data-group="set1" title="" class="html5lightbox"><img src="assets/img/gallery2.jpg" alt=""></a></li>
				<li class="width3 wow zoomIn" data-wow-duration="1000ms" style="visibility: visible; animation-duration: 1000ms; animation-name: jb; position: absolute; left: 496px; top: 0px;"><a href="assets/img/gallery4.jpg" data-group="set1" title="" class="html5lightbox"><img src="assets/img/gallery4.jpg" alt=""></a></li>
				<li class="width4 wow zoomIn" data-wow-duration="1000ms" style="visibility: visible; animation-duration: 1000ms; animation-name: jb; position: absolute; left: 693px; top: 0px;"><a href="assets/img/gallery6.jpg" data-group="set1" title="" class="html5lightbox"><img src="assets/img/gallery6.jpg" alt="" class="hoverZoomLink"></a></li>
				<li class="width5 wow zoomIn" data-wow-duration="1000ms" style="visibility: visible; animation-duration: 1000ms; animation-name: jb; position: absolute; left: 873px; top: 0px;"><a href="assets/img/gallery8.jpg" data-group="set1" title="" class="html5lightbox"><img src="assets/img/gallery8.jpg" alt=""></a></li>
				<li class="width6 wow zoomIn" data-wow-duration="1000ms" style="visibility: visible; animation-duration: 1000ms; animation-name: jb; position: absolute; left: 693px; top: 211px;"><a href="assets/img/gallery7.jpg" data-group="set1" title="" class="html5lightbox"><img src="assets/img/gallery7.jpg" alt=""></a></li>
				<li class="width7 wow zoomIn" data-wow-duration="1000ms" style="visibility: visible; animation-duration: 1000ms; animation-name: jb; position: absolute; left: 891px; top: 211px;"><a href="assets/img/gallery9.jpg" data-group="set1" title="" class="html5lightbox"><img src="assets/img/gallery9.jpg" alt=""></a></li>
				<li class="width8 wow zoomIn" data-wow-duration="1000ms" style="visibility: visible; animation-duration: 1000ms; animation-name: jb; position: absolute; left: 1089px; top: 211px;"><a href="assets/img/gallery10.jpg" data-group="set1" title="" class="html5lightbox"><img src="assets/img/gallery10.jpg" alt=""></a></li>
				<li class="width9 wow zoomIn" data-wow-duration="1000ms" style="visibility: visible; animation-duration: 1000ms; animation-name: jb; position: absolute; left: 199px; top: 379px;"><a href="assets/img/gallery3.jpg" data-group="set1" title="" class="html5lightbox"><img src="assets/img/gallery3.jpg" alt=""></a></li>
				<li class="width10 wow zoomIn" data-wow-duration="1000ms" style="visibility: visible; animation-duration: 1000ms; animation-name: jb; position: absolute; left: 496px; top: 329px;"><a href="assets/img/gallery5.jpg" data-group="set1" title="" class="html5lightbox"><img src="assets/img/gallery5.jpg" alt=""></a></li>
			</ul>
		</div> -->
	</div>
</section><!--about-us-section end-->


{{-- <section class="page-content call-to-action-1  p-0">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="blog-section py-5 m-0 posts-page">
					<div class="blog-posts">
						<div class="blog-post quote-post">
							<div class="blog-info">
								<span class="category">{{__("welcome.call.title1")}}</span>
<ul class="meta">
	<!-- <li><a href="#" title="">17/09/2020</a></li> -->
	<!-- <li><a href="#" title="">by Admin</a></li> -->
	<!-- <li><img src="assets/img/icon13.png" alt="" /><a href="#" title="">Teachers,</a><a href="#" title="">
											School</a></li> -->
</ul>
<p>{{__("welcome.call.text1")}}</p>
<a href="#contact">{{__("welcome.call.button1")}}</a>
<!-- <span>Mother</span> -->
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section> --}}

<section class="newsletter-section call">
	<div class="container">
		<div class="newsletter-sec">
			<div class="d-flex flex-column text-center align-items-center">
				<div class="col-lg-4">
					<div class="newsz-ltr-text">
						<h2>{{__("welcome.call.title1")}}</h2>
					</div><!--newsz-ltr-text end-->
				</div>
				<div class="text-center col-lg-10">
					<p>{{__("welcome.call.text1")}}</p>
					<a href="#pricing" title="" class="w-fit btn-default mt-4">{{__("welcome.call.button1")}} <i class="fa fa-long-arrow-alt-right"></i></a>
					<!-- <form class="newsletter-form">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="name" placeholder="Name">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="email" name="email" placeholder="Email">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group select-tg">
									<select>
										<option>Class</option>
										<option>Class</option>
										<option>Class</option>
										<option>Class</option>
										<option>Class</option>
										<option>Class</option>
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<textarea name="message" placeholder="Message"></textarea>
								</div>
							</div>
						</div>
					</form> -->
				</div>
			</div>
		</div><!--newsletter-sec end-->
	</div>
</section>

<section class="about-page-content pt-4">
	<div class="container">
		<div class="abt-page-row">
			<div class="row align-items-center">
				<div class="col-lg-6 col-md-6">
					<div class="section-title">
						<h2><span>ذ. عبد الصمد أشتاشن </span></h2>
						<!-- <p class="mw-100"></p> -->
						<!-- <a href="classes.html" title="" class="btn-default">Classes <i class="fa fa-long-arrow-alt-right"></i></a> -->
					</div>
					<div class="act-inffo">
						<!-- <span>ABOUT US</span>
						<h2>Our Mission</h2> -->
						<!-- <p>Praesent rhoncus justo erat, sed sollicitudin arcu malesuada vel. Etiam scelerisque justo ut purus luctus ullamcorper. Vivamus vitae elit ligula. Fusce eu rutrum nisl.</p> -->
						<ul>
							<li>رئيس معهد العلوم العصبية - المغرب</li>

							<li>أخصائي علاج سلوكي معرفي</li>

							<li>أخصائي علاج اضطرابات التعلم</li>

							<li>أستاذ بجامعة محمد الخامس – الرباط</li>

							<li>أستاذ في المدرسة الوطنية للتجارة والتسيير – طنجة</li>

							<li>حاصل على ماستر في الجودة، الصحة، السلامة، البيئة والتنمية المستدامة</li>

							<li>حاصل على ماستر في التدبير الاستراتيجي للموارد البشرية</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="abt-img">
						<img src="assets/img/abt1.png" alt="">
					</div><!--avt-img end-->
				</div>

			</div>
		</div><!--abt-page-row end-->
	</div>
</section><!--about-page-content end-->

<section>
	<div class="news-block-two ">
		<div class="inner-box">
			<section class="services-section">
				<div class="container">
					<div class="sec-title right-align">
						<h2>
							{!!__('transelt.titre1')!!}
						</h2>
					</div>
					<div class="row clearfix">
						<!-- Service Block -->
						<div class="service-block col-lg-3 col-md-4 col-sm-6">
							<div class="inner-box">
								<div class="icon-box">
									<span class="icon"><img src="{{asset('images/icons/fea/9.png')}}" alt="" /></span>
								</div>
								{!!__('transelt.h51')!!}
							</div>
						</div>
						<!-- Service Block -->
						<div class="service-block col-lg-3 col-md-4 col-sm-6">
							<div class="inner-box">
								<div class="icon-box">
									<span class="icon"><img src="{{asset('images/icons/fea/4.png')}}" alt="" /></span>
								</div>
								{!!__('transelt.h52')!!}
							</div>
						</div>
						<!-- Service Block -->
						<div class="service-block col-lg-3 col-md-4 col-sm-6">
							<div class="inner-box">
								<div class="icon-box">
									<span class="icon"><img src="{{asset('images/icons/fea/8.png')}}" alt="" /></span>
								</div>
								{!!__('transelt.h53')!!}
							</div>
						</div>
						<!-- Service Block -->
						<div class="service-block col-lg-3 col-md-4 col-sm-6">
							<div class="inner-box">
								<div class="icon-box">
									<span class="icon"><img src="{{asset('images/icons/fea/5.png')}}" alt="" /></span>
								</div>
								{!!__('transelt.h54')!!}
							</div>
						</div>
						<!-- Service Block -->
						<div class="service-block col-lg-3 col-md-4 col-sm-6">
							<div class="inner-box">
								<div class="icon-box">
									<span class="icon"><img src="{{asset('images/icons/fea/12.png')}}" alt="" /></span>
								</div>
								{!!__('transelt.h55')!!}
							</div>
						</div>


						<!-- Service Block -->
						<div class="service-block col-lg-3 col-md-4 col-sm-6">
							<div class="inner-box">
								<div class="icon-box">
									<span class="icon slide-up"><img src="{{asset('images/icons/fea/1.png')}}" alt="" /></span>
								</div>
								{!!__('transelt.h56')!!}
							</div>
						</div>

						<!-- Service Block -->
						<div class="service-block col-lg-3 col-md-4 col-sm-6">
							<div class="inner-box">
								<div class="icon-box">
									<span class="icon"><img src="{{asset('images/icons/fea/2.png')}}" alt="" /></span>
								</div>
								{!!__('transelt.h57')!!}
							</div>
						</div>

						<!-- Service Block -->
						<div class="service-block col-lg-3 col-md-4 col-sm-6">
							<div class="inner-box">
								<div class="icon-box">
									<span class="icon"><img src="{{asset('images/icons/fea/3.png')}}" alt="" /></span>
								</div>
								{!!__('transelt.h58')!!}
							</div>
						</div>





						<!-- Service Block -->
						<div class="service-block col-lg-3 col-md-4 col-sm-6">
							<div class="inner-box">
								<div class="icon-box">
									<span class="icon"><img src="{{asset('images/icons/fea/6.png')}}" alt="" /></span>
								</div>
								{!!__('transelt.h59')!!}
							</div>
						</div>

						<!-- Service Block -->
						<div class="service-block col-lg-3 col-md-4 col-sm-6">
							<div class="inner-box">
								<div class="icon-box">
									<span class="icon"><img src="{{asset('images/icons/fea/7.png')}}" alt="" /></span>
								</div>
								{!!__('transelt.h510')!!}
							</div>
						</div>





						<!-- Service Block -->
						<div class="service-block col-lg-3 col-md-4 col-sm-6">
							<div class="inner-box">
								<div class="icon-box">
									<span class="icon"><img src="{{asset('images/icons/fea/10.png')}}" alt="" /></span>
								</div>
								{!!__('transelt.h511')!!}
							</div>
						</div>

						<!-- Service Block -->
						<div class="service-block col-lg-3 col-md-4 col-sm-6">
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


<section class="course-section">
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
</section>

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

<section id="pricing" class="d-flex min-h-screen ">
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

	</div>
</section>


<section class="page-content mt-5 pt-2 pb-0">
	<div class="container pt-5">
		<div class="mdp-contact">
			<div class="row">
				<div class="col-lg-7 gap-3 col-md-7">
					<div class="sec-title comment-area">
						<h2 class="mb-5">{{ __("contact.contact_us")}}</h2>
						<form id="contact-form" method="post" action="#">
							<div class="response"></div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<input type="text" name="name" class="name" placeholder="{{ __('contact.full_name') }}" required>
									</div><!--form-group end-->
								</div>
								<div class="col-lg-6">
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
								<div class="d-flex flex-wrap">
									<div class="icon-v">
										<img src="assets/img/icon15.png" alt="">
									</div>
									<div class="dd-cont">
										<h4>{{ __('contact.phone') }}</h4>
										<div class="d-flex">
											<span dir="ltr"><a target="_blank" href="tel:212539324232">+212 539 32 42 32</a></span>
											<div class="vr mx-2"></div>
											<span dir="ltr"><a target="_blank" href="tel:212661553765">+212 661 55 37 65</a></span>
											<div class="vr mx-2"></div>
											<span dir="ltr"><a target="_blank" href="https://wa.me/212667325757">+212 667 32 57 57</a></span>
										</div>
									</div>
								</div>
							</li>
							<li>
								<div class="d-flex flex-wrap">
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
								<div class="d-flex flex-wrap">
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
</section>


{{--
	<section class="classes-section">
		<div class="container">
			<div class="sec-title">
				<h2>Our Classes</h2>
				<p>Nam mattis felis id sodales rutrum. Nulla ornare tristique mauris, a laoreet erat ornare sit amet. Nulla sagittis faucibus lacus</p>
			</div><!--sec-title end-->
			<div class="classes-sec">
				<div class="row classes-carousel">
					<div class="col-lg-3">
						<div class="classes-col wow fadeInUp" data-wow-duration="1000ms">
							<div class="class-thumb">
								<img src="https://via.placeholder.com/1680x1120" alt="" class="w-100">
								<a href="contacts.html" title="" class="crt-btn">
									<img src="assets/img/icon10.png" alt="">
								</a>
							</div>
							<div class="class-info">
								<h3><a href="class-single.html" title="">Basic English Speaking and Grammar</a></h3>
								<span>Mon-Fri</span>
								<span>10 AM - 12 AM</span>
								<div class="d-flex flex-wrap align-items-center">
									<div class="posted-by">
										<img src="https://via.placeholder.com/26x26" alt="">
										<a href="#" title="">Amanda Kern</a>
									</div>
									<strong class="price">$45</strong>
								</div>
							</div>
						</div><!--classes-col end-->
					</div>
					<div class="col-lg-3">
						<div class="classes-col wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="200ms">
							<div class="class-thumb">
								<img src="https://via.placeholder.com/1970x1326" alt="" class="w-100">
								<a href="contacts.html" title="" class="crt-btn">
									<img src="assets/img/icon10.png" alt="">
								</a>
							</div>
							<div class="class-info">
								<h3><a href="class-single.html" title="">Natural Sciences & Mathematics Courses</a></h3>
								<span>Mon-Fri</span>
								<span>10 AM - 12 AM</span>
								<div class="d-flex flex-wrap align-items-center">
									<div class="posted-by">
										<img src="https://via.placeholder.com/26x26" alt="">
										<a href="#" title="">Gypsy Hardinge</a>
									</div>
									<strong class="price">$67</strong>
								</div>
							</div>
						</div><!--classes-col end-->
					</div>
					<div class="col-lg-3">
						<div class="classes-col wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="400ms">
							<div class="class-thumb">
								<img src="https://via.placeholder.com/1440x960" alt="" class="w-100">
								<a href="contacts.html" title="" class="crt-btn">
									<img src="assets/img/icon10.png" alt="">
								</a>
							</div>
							<div class="class-info">
								<h3><a href="class-single.html" title="">Environmental Studies & Earth Sciences</a></h3>
								<span>Mon-Fri</span>
								<span>10 AM - 12 AM</span>
								<div class="d-flex flex-wrap align-items-center">
									<div class="posted-by">
										<img src="https://via.placeholder.com/26x26" alt="">
										<a href="#" title="">Margje Jutten</a>
									</div>
									<strong class="price">$89</strong>
								</div>
							</div>
						</div><!--classes-col end-->
					</div>
					<div class="col-lg-3">
						<div class="classes-col wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="600ms">
							<div class="class-thumb">
								<img src="https://via.placeholder.com/1296x864" alt="" class="w-100">
								<a href="contacts.html" title="" class="crt-btn">
									<img src="assets/img/icon10.png" alt="">
								</a>
							</div>
							<div class="class-info">
								<h3><a href="class-single.html" title="">Hospitality, Leisure & Sports Courses</a></h3>
								<span>Mon-Fri</span>
								<span>10 AM - 12 AM</span>
								<div class="d-flex flex-wrap align-items-center">
									<div class="posted-by">
										<img src="https://via.placeholder.com/26x26" alt="">
										<a href="#" title="">Hubert Franck</a>
									</div>
									<strong class="price">$67</strong>
								</div>
							</div>
						</div><!--classes-col end-->
					</div>
					<div class="col-lg-3">
						<div class="classes-col">
							<div class="class-thumb">
								<img src="https://via.placeholder.com/1680x1120" alt="" class="w-100">
								<a href="contacts.html" title="" class="crt-btn">
									<img src="assets/img/icon10.png" alt="">
								</a>
							</div>
							<div class="class-info">
								<h3><a href="class-single.html" title="">Basic English Speaking and Grammar</a></h3>
								<span>Mon-Fri</span>
								<span>10 AM - 12 AM</span>
								<div class="d-flex flex-wrap align-items-center">
									<div class="posted-by">
										<img src="https://via.placeholder.com/26x26" alt="">
										<a href="#" title="">Amanda Kern</a>
									</div>
									<strong class="price">$45</strong>
								</div>
							</div>
						</div><!--classes-col end-->
					</div>
					<div class="col-lg-3">
						<div class="classes-col">
							<div class="class-thumb">
								<img src="https://via.placeholder.com/1970x1326" alt="" class="w-100">
								<a href="contacts.html" title="" class="crt-btn">
									<img src="assets/img/icon10.png" alt="">
								</a>
							</div>
							<div class="class-info">
								<h3><a href="class-single.html" title="">Natural Sciences & Mathematics Courses</a></h3>
								<span>Mon-Fri</span>
								<span>10 AM - 12 AM</span>
								<div class="d-flex flex-wrap align-items-center">
									<div class="posted-by">
										<img src="https://via.placeholder.com/26x26" alt="">
										<a href="#" title="">Gypsy Hardinge</a>
									</div>
									<strong class="price">$67</strong>
								</div>
							</div>
						</div><!--classes-col end-->
					</div>
					<div class="col-lg-3">
						<div class="classes-col">
							<div class="class-thumb">
								<img src="https://via.placeholder.com/1440x960" alt="" class="w-100">
								<a href="contacts.html" title="" class="crt-btn">
									<img src="assets/img/icon10.png" alt="">
								</a>
							</div>
							<div class="class-info">
								<h3><a href="class-single.html" title="">Environmental Studies & Earth Sciences</a></h3>
								<span>Mon-Fri</span>
								<span>10 AM - 12 AM</span>
								<div class="d-flex flex-wrap align-items-center">
									<div class="posted-by">
										<img src="https://via.placeholder.com/26x26" alt="">
										<a href="#" title="">Margje Jutten</a>
									</div>
									<strong class="price">$89</strong>
								</div>
							</div>
						</div><!--classes-col end-->
					</div>
					<div class="col-lg-3">
						<div class="classes-col">
							<div class="class-thumb">
								<img src="https://via.placeholder.com/1296x864" alt="" class="w-100">
								<a href="contacts.html" title="" class="crt-btn">
									<img src="assets/img/icon10.png" alt="">
								</a>
							</div>
							<div class="class-info">
								<h3><a href="class-single.html" title="">Hospitality, Leisure & Sports Courses</a></h3>
								<span>Mon-Fri</span>
								<span>10 AM - 12 AM</span>
								<div class="d-flex flex-wrap align-items-center">
									<div class="posted-by">
										<img src="https://via.placeholder.com/26x26" alt="">
										<a href="#" title="">Hubert Franck</a>
									</div>
									<strong class="price">$67</strong>
								</div>
							</div>
						</div><!--classes-col end-->
					</div>
				</div>
				<div class="lnk-dv text-center">
					<a href="classes.html" title="" class="btn-default">Classes <i class="fa fa-long-arrow-alt-right"></i></a>
				</div>
			</div><!--classes-sec end-->
		</div>
	</section><!--classes-section end-->

	<section class="teachers-section">
		<div class="container">
			<div class="section-title text-center">
				<h2>Our Awesome <br /> Teachers</h2>
				<p>Quisque id ultrices tellus, ac sodales ex. Cras nec ante viverra, bibendum justo eget, lacinia dui. Donec ligula ligula, elementum sit amet</p>
			</div><!--section-title end-->
			<div class="teachers">
				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-6 col-6 full-wdth">
						<div class="teacher">
							<div class="teacher-img">
								<img src="https://via.placeholder.com/1120x1680" alt="" class="w-100">
								<div class="sc-div">
									<ul>
										<li><a href="https://www.instagram.com/neuralbox/" title="Neuralbox Instagram account"><i class="fab fa-instagram"></i></a></li>
										<li><a href="#" title=""><i class="fab fa-linkedin-in"></i></a></li>
										<li><a href="#" title=""><i class="fab fa-facebook-f"></i></a></li>
									</ul>
									<span><img src="assets/img/plus.png" alt=""></span>
								</div>
							</div>
							<div class="teacher-info">
								<h3><a href="teacher-single.html" title="">Polina Kerston</a></h3>
								<span>English Teacher</span>
							</div>
						</div><!--teacher end-->
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-6 full-wdth">
						<div class="teacher">
							<div class="teacher-img">
								<img src="https://via.placeholder.com/1376x2064" alt="" class="w-100">
								<div class="sc-div">
									<ul>
										<li><a href="https://www.instagram.com/neuralbox/" title="Neuralbox Instagram account"><i class="fab fa-instagram"></i></a></li>
										<li><a href="#" title=""><i class="fab fa-linkedin-in"></i></a></li>
										<li><a href="#" title=""><i class="fab fa-facebook-f"></i></a></li>
									</ul>
									<span><img src="assets/img/plus.png" alt=""></span>
								</div>
							</div>
							<div class="teacher-info">
								<h3><a href="teacher-single.html" title="">Faadi Al Rahman</a></h3>
								<span>Instructor</span>
							</div>
						</div><!--teacher end-->
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-6 full-wdth">
						<div class="teacher">
							<div class="teacher-img">
								<img src="https://via.placeholder.com/1336x2004" alt="" class="w-100">
								<div class="sc-div">
									<ul>
										<li><a href="https://www.instagram.com/neuralbox/" title="Neuralbox Instagram account"><i class="fab fa-instagram"></i></a></li>
										<li><a href="#" title=""><i class="fab fa-linkedin-in"></i></a></li>
										<li><a href="#" title=""><i class="fab fa-facebook-f"></i></a></li>
									</ul>
									<span><img src="assets/img/plus.png" alt=""></span>
								</div>
							</div>
							<div class="teacher-info">
								<h3><a href="teacher-single.html" title="">Chikelu Obasea</a></h3>
								<span>Art Teacher</span>
							</div>
						</div><!--teacher end-->
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-6 full-wdth">
						<div class="teacher">
							<div class="teacher-img">
								<img src="https://via.placeholder.com/1204x1804" alt="" class="w-100">
								<div class="sc-div">
									<ul>
										<li><a href="https://www.instagram.com/neuralbox/" title="Neuralbox Instagram account"><i class="fab fa-instagram"></i></a></li>
										<li><a href="#" title=""><i class="fab fa-linkedin-in"></i></a></li>
										<li><a href="#" title=""><i class="fab fa-facebook-f"></i></a></li>
									</ul>
									<span><img src="assets/img/plus.png" alt=""></span>
								</div>
							</div>
							<div class="teacher-info">
								<h3><a href="teacher-single.html" title="">Katayama Fumiki</a></h3>
								<span>Teacher</span>
							</div>
						</div><!--teacher end-->
					</div>
				</div>
			</div><!--teachers end-->
		</div>
	</section>


	<section class="blog-section">
		<div class="container">
			<div class="section-title text-center">
				<h2>Recent News</h2>
				<p>Nam mattis felis id sodales rutrum. Nulla ornare tristique mauris, a laoreet erat ornare sit amet. Nulla sagittis faucibus lacusMorbi lorem sem, aliquet</p>
			</div><!--section-title end-->
			<div class="blog-posts">
				<div class="row">
					<div class="col-lg-4 col-md-6 col-sm-6">
						<div class="blog-post">
							<div class="blog-thumbnail">
								<img src="https://via.placeholder.com/1680x1120" alt="" class="w-100">
								<span class="category">English</span>
							</div>
							<div class="blog-info">
								<ul class="meta">
									<li><a href="#" title="">17/09/2020</a></li>
									<li><a href="#" title="">by Admin</a></li>
									<li><img src="assets/img/icon13.png" alt="" /><a href="#" title="">Teachers,</a><a href="#" title=""> School</a></li>
								</ul>
								<h3><a href="post.html" title="">Campus clean workshop</a></h3>
								<p>Nam mattis felis id sodales rutrum. Nulla ornare tristique mauris, a laoreet erat ornare sit amet</p>
								<a href="post.html" title="" class="read-more">Read <i class="fa fa-long-arrow-alt-right"></i></a>
							</div>
						</div><!--blog-post end-->
					</div>
					<div class="col-lg-4 col-md-6 col-sm-6">
						<div class="blog-post">
							<div class="blog-thumbnail">
								<img src="https://via.placeholder.com/1440x960" alt="" class="w-100">
								<span class="category">English</span>
							</div>
							<div class="blog-info">
								<ul class="meta">
									<li><a href="#" title="">17/09/2020</a></li>
									<li><a href="#" title="">by Admin</a></li>
									<li><img src="assets/img/icon13.png" alt="" /><a href="#" title="">Teachers,</a><a href="#" title=""> School</a></li>
								</ul>
								<h3><a href="post.html" title="">Campus clean workshop</a></h3>
								<p>Nam mattis felis id sodales rutrum. Nulla ornare tristique mauris, a laoreet erat ornare sit amet</p>
								<a href="post.html" title="" class="read-more">Read <i class="fa fa-long-arrow-alt-right"></i></a>
							</div>
						</div><!--blog-post end-->
					</div>
					<div class="col-lg-4 col-md-6 col-sm-6">
						<div class="blog-post">
							<div class="blog-thumbnail">
								<img src="https://via.placeholder.com/1680x1120" alt="" class="w-100">
								<span class="category">English</span>
							</div>
							<div class="blog-info">
								<ul class="meta">
									<li><a href="#" title="">17/09/2020</a></li>
									<li><a href="#" title="">by Admin</a></li>
									<li><img src="assets/img/icon13.png" alt="" /><a href="#" title="">Teachers,</a><a href="#" title=""> School</a></li>
								</ul>
								<h3><a href="post.html" title="">Campus clean workshop</a></h3>
								<p>Nam mattis felis id sodales rutrum. Nulla ornare tristique mauris, a laoreet erat ornare sit amet</p>
								<a href="post.html" title="" class="read-more">Read <i class="fa fa-long-arrow-alt-right"></i></a>
							</div>
						</div><!--blog-post end-->
					</div>
				</div>
			</div><!--blog-posts end-->
		</div>
	</section><!--blog-section end-->

	<section class="newsletter-section">
		<div class="container">
			<div class="newsletter-sec">
				<div class="row align-items-center">
					<div class="col-lg-4">
						<div class="newsz-ltr-text">
							<h2>Join us <br /> and stay tuned!</h2>
							<a href="contacts.html" title="" class="btn-default">Join Us <i class="fa fa-long-arrow-alt-right"></i></a>
						</div><!--newsz-ltr-text end-->
					</div>
					<div class="col-lg-8">
						<form class="newsletter-form">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" name="name" placeholder="Name">
									</div><!--form-group end-->
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="email" name="email" placeholder="Email">
									</div><!--form-group end-->
								</div>
								<div class="col-md-4">
									<div class="form-group select-tg">
										<select>
											<option>Class</option>
											<option>Class</option>
											<option>Class</option>
											<option>Class</option>
											<option>Class</option>
											<option>Class</option>
										</select>
									</div><!--form-group end-->
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<textarea name="message" placeholder="Message"></textarea>
									</div><!--form-group end-->
								</div>
							</div>
						</form><!--newsletter-form end-->
					</div>
				</div>
			</div><!--newsletter-sec end-->
		</div>
	</section><!--newsletter-sec end-->
--}}

@endsection
@section('footer','footer')