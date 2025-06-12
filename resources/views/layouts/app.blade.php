<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title')</title>
	<!-- Stylesheets -->

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/all.css" />

	<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/sharp-solid.css" />

	<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/sharp-regular.css" />

	<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/sharp-light.css" />

	<link rel="stylesheet" type="text/css" href="assets/css/animate.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
	<!-- <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/bootstrap.css"> -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
	<link
		rel="stylesheet"
		href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

	<link rel="stylesheet" type="text/css" href="assets/css/main.css">

</head>

<body dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">


	<div class="wrapper">

		<div class="main-section">

			<header>
				<div class="container">
					<div class="header-content d-flex flex-wrap align-items-center">
						<div class="logo">
							<a href="index.html" title="">
								<img src="assets/img/logo.png" alt="">
							</a>
						</div><!--logo end-->
						<ul class="contact-add d-flex justify-content-end flex-wrap">
							<li>
								<div class="contact-info">
									<img src="assets/img/icon1.png" alt="">
									<div class="contact-tt">
										<h4>{{ __("contact.appeler") }}</h4>
										<span dir="ltr">+212 661 55 37 65</span>
									</div>
								</div><!--contact-info end-->
							</li>
							{{-- <li>
								<div class="contact-info">
									<img src="assets/img/icon2.png" alt="">
									<div class="contact-tt">
										<h4>Work Time</h4>
										<span>Mon - Fri 8 AM - 5 PM</span>
									</div>
								</div><!--contact-info end-->
							</li> --}}
							<li>
								<div class="contact-info">
									<img src="assets/img/icon3.png" alt="">
									<div class="contact-tt">
										<h4>{{ __("contact.addresse") }}</h4>
										<span>{{ __("contact.addresseDesc") }}</span>
									</div>
								</div><!--contact-info end-->
							</li>
						</ul><!--contact-information end-->
						<div class="menu-btn">
							<a href="#">
								<span class="bar1"></span>
								<span class="bar2"></span>
								<span class="bar3"></span>
							</a>
						</div><!--menu-btn end-->
					</div><!--header-content end-->
					<div class="navigation-bar d-flex flex-wrap align-items-center">
						<nav>
							<ul>
								<li><a class="active" href="{{ route('neuralbox') }}" title="">{{ __("nav.neural-guide") }}</a></li>
								<li><a href="{{ route('neuralbox') }}" title="">{{ __("nav.peda") }}</a></li>
								<li><a href="{{ route('suivre') }}" title="">{{ __("nav.suivre") }}</a></li>
								<li><a href="{{ route('about') }}" title="">{{ __("nav.about") }}</a></li>
								<li><a href="{{ route('login') }}" title="">{{ __("nav.login") }}</a></li>
								<li><a href="{{ route('register') }}" title="">{{ __("nav.signUp") }}</a></li>
							</ul>
						</nav><!--nav end-->
						<ul class="social-links ms-auto">
							<li><a href="#" title=""><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="#" title=""><i class="fab fa-linkedin-in"></i></a></li>
							<li><a href="#" title=""><i class="fab fa-instagram"></i></a></li>
						</ul>
					</div>
				</div>
			</header>

			<div class="responsive-menu">
				<ul>
					<li><a href="index.html" title="">NeuralBox guide</a></li>
					<li><a href="about.html" title="">About</a></li>
					<li><a href="events.html" title="">Events</a></li>
					<li><a href="event-single.html" title="">Event Single</a></li>
					<li><a href="schedule.html" title="">Schedule</a></li>
					<li><a href="classes.html" title="">Classes</a></li>
					<li><a href="class-single.html" title="">Classe Single</a></li>
					<li><a href="teachers.html" title="">Teachers</a></li>
					<li><a href="teacher-single.html" title="">Teacher Single</a></li>
					<li><a href="blog.html" title="">Blog</a></li>
					<li><a href="post.html" title="">Blog Single</a></li>
					<li><a href="contacts.html" title="">Contacts</a></li>
					<li><a href="error.html" title="">404</a></li>
				</ul>
			</div><!--responsive-menu end-->




			@yield("content")
			<footer>
				<div class="container">
					<div class="top-footer">
						<div class="row">
							<div class="col-lg-3 col-md-6 col-sm-6">
								<div class="widget widget-about">
									<img src="assets/img/logo.svg" alt="">
									<p>Vivamus porta efficitur nibh nec convallis. Vestibulum egestas eleifend justo. Ut tellus ipsum, accumsan</p>
								</div><!--widget-about end-->
							</div>
							<div class="col-lg-3 col-md-6 col-sm-6">
								<div class="widget widget-contact">
									<ul class="contact-add">
										<li>
											<div class="contact-info">
												<img src="assets/img/icon1.png" alt="">
												<div class="contact-tt">
													<h4>Call</h4>
													<span>+2 342 5446 67</span>
												</div>
											</div><!--contact-info end-->
										</li>
										<li>
											<div class="contact-info">
												<img src="assets/img/icon2.png" alt="">
												<div class="contact-tt">
													<h4>Work Time</h4>
													<span>Mon - Fri 8 AM - 5 PM</span>
												</div>
											</div><!--contact-info end-->
										</li>
										<li>
											<div class="contact-info">
												<img src="assets/img/icon3.png" alt="">
												<div class="contact-tt">
													<h4>Address</h4>
													<span>Franklin St, Greenpoint Ave</span>
												</div>
											</div><!--contact-info end-->
										</li>
									</ul>
								</div><!--widget-contact end-->
							</div>
							<div class="col-lg-3 col-md-6 col-sm-6">
								<div class="widget widget-links">
									<h3 class="widget-title">Quick Links</h3>
									<ul>
										<li><a href="about.html" title="">About Us </a></li>
										<li><a href="classes.html" title="">Our Classes</a></li>
										<li><a href="teachers.html" title="">School Teachers </a></li>
										<li><a href="events.html" title="">Recent Events </a></li>
										<li><a href="blog.html" title="">Our News </a></li>
										<li><a href="schedule.html" title="">Schedule </a></li>
									</ul>
								</div><!--widget-links end-->
							</div>
							<div class="col-lg-3 col-md-6 col-sm-6">
								<div class="widget widget-iframe">
									<iframe src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=1%20Grafton%20Street,%20Dublin,%20Ireland+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
								</div><!--widget-iframe end-->
							</div>
						</div>
					</div><!--top-footer end-->
					<div class="bottom-footer">
						<div class="row align-items-center">
							<div class="col-lg-6 col-md-6 col-sm-6">
								<p>© Copyrights 2020 Shelly All rights reserved</p>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6">
								<ul class="social-links">
									<li><a href="#" title=""><i class="fab fa-facebook-f"></i></a></li>
									<li><a href="#" title=""><i class="fab fa-linkedin-in"></i></a></li>
									<li><a href="#" title=""><i class="fab fa-instagram"></i></a></li>
								</ul>
							</div>
						</div>
					</div><!--bottom-footer end-->
				</div>
			</footer><!--footer end-->

			<!--back to top begin-->
			<button class="back-to-top">
				<i class="fas fa-arrow-up"></i>
			</button>
			<!--back to top end-->

		</div>


		<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

		<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		<script src="assets/js/jquery.js"></script>
		<!-- <script src="assets/js/bootstrap/bootstrap.min.js"></script> -->
		<script src="assets/js/isotope.js"></script>
		<script src="assets/js/html5lightbox.js"></script>
		<script src="assets/js/slick.min.js"></script>
		<script src="assets/js/tweenMax.js"></script>
		<script src="assets/js/wow.min.js"></script>
		<script src="assets/js/scripts.js"></script>

</body>

</html>