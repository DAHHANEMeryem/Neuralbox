<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <!-- Stylesheets -->

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="icon" type="image/svg" href="{{ asset('assets/img/favicon.svg') }}" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/all.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/sharp-solid.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/sharp-regular.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/sharp-light.css" />

    <link rel="stylesheet" type="text/css" href="assets/css/animate.css">


    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/bootstrap.css"> -->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">

</head>

<body dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    @stack('navData')


    <div class="wrapper" @hasSection('background') style="background: @yield('background')" @endif>

        <div class="main-section" @hasSection('background') style="background:url('') ;height: inherit;backdrop-filter: blur(5rem);" @endif>

            <header>
                <div class="container">
                    <div @class(['header-content d-flex flex-wrap align-items-center',$navTheme ?? ' ' ])>
                        <div class="logo">
                            <a href="{{ route('home') }}" title="">
                                <img src="assets/img/logo.png" alt="">
                            </a>
                        </div><!--logo end-->
                        <ul class="social-links ms-auto">
                            <li><a href="#" title="NeuralBox facebook account"><i class="fab fa-facebook-f  "></i></a></li>
                            <li><a href="https://www.instagram.com/neuralbox/" title="Neuralbox instagram"><i class="fab fa-instagram "></i></a></li>
                            <li><a href="https://www.youtube.com/@TAQASOM.Podcast" title="Neuralbox Youtube channel"><i class="fab fa-youtube "></i></a></li>
                        </ul>
                        <ul class="contact-add d-flex justify-content-end flex-wrap">
                            <li>
                                <div class="contact-info">
                                    <a href="https:/wa.me/212667325757" target="_blank" class="ms-2">
                                        <i class="fab fa-whatsapp fs-4 " style="color:#f37335"></i>
                                        <div class="contact-tt">
                                            <!-- <h4>{{ __("contact.appeler") }}</h4> -->
                                            <span dir="ltr">+212 667 32 57 57</span>
                                        </div>
                                    </a>
                                    <a href="tel:+212539324232"><img src="assets/img/icon1.png" alt="">
                                        <div class="contact-tt">
                                            <!-- <h4>{{ __("contact.appeler") }}</h4> -->
                                            <span dir="ltr">+212 539 32 42 32</span>
                                        </div>
                                    </a>
                                </div><!--contact-info end-->
                            </li>
                            {{-- <li>
								<div class="contact-info">
									<img src="assets/img/icon2.png" alt="">
									<div class="contact-tt">
										<!-- <h4>Work Time</h4> -->
										<!-- <span>Mon</span> -->
									</div>
								</div><!--contact-info end-->
							</li> --}}
                            <li>
                                <div class="contact-info">
                                    <img src="assets/img/icon3.png" alt="">
                                    <div class="contact-tt">
                                        {{-- <h4>{{ __("contact.addresse") }}</h4> --}}
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
                    <div @class(["navigation-bar d-flex justify-content-between align-items-center",$navTheme ?? ' ' ])>
                        <nav >
                            <ul>
                                @if(Auth::check() && Auth::user()->is_admin)<li><a class="{{(Route::current()->getName() === 'admin.dashboard') ? 'active' : ''}}" href="{{ route('admin.dashboard') }}" title="">{{ __("nav.admin_dashboard") }}</a></li>@endif
                                <li><a class="{{(Route::current()->getName() === 'home') ? 'active' : ''}}" href="{{ route('home') }}" title="">{{ __("nav.home") }}</a></li>
                                <li><a class="{{(Route::current()->getName() === 'neuralbox') ? 'active' : ''}}" href="{{ route('neuralbox') }}" title="">{{ __("nav.neural-guide") }}</a></li>
                                <li><a class="{{(Route::current()->getName() === 'peda') ? 'active' : ''}}" href="{{ route('peda') }}" title="">{{ __("nav.peda") }}</a></li>
                                <li><a class="{{(Route::current()->getName() === 'suivre') ? 'active' : ''}}" href="{{ route('suivre') }}" title="">{{ __("nav.suivre") }}</a></li>
                                <li><a class="{{(Route::current()->getName() === 'about') ? 'active' : ''}}" href="{{ route('about') }}" title="">{{ __("nav.about") }}</a></li>
                                
                            </ul>
                            
                        </nav><!--nav end-->
                        <nav>
                            <ul>
                                @if(!Auth::check() || !Auth::user()->subscription_type)<li class="bg-primary  p-2 rounded-5"><a class="text-white" href="{{ route('payment.form') }}" title="">{{ __("nav.pricing") }}</a></li>@endif

                                @auth
                                <li>
                                    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                                        @csrf
                                    </form>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('nav.logout') }}
                                    </a>

                                </li>
                                @else
                                <li><a href="" data-bs-toggle="modal" data-bs-target="#authModal" id="payment-button-disable">{{ __("nav.login") }}</a></li>
                                <!-- <li><a href="" data-bs-toggle="modal" data-bs-target="#authModal" id="payment-button-disable">{{ __("nav.signUp") }}</a></li> -->
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
            </header>

            <div class="responsive-menu">
                <ul>
                    <li><a href="{{ route('home') }}" title="">Accueil</a></li>
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
            @hasSection('footer')
            <footer>
                <div class="container">
                    <div class="top-footer">
                        <div class="row align-items-center justify-content-between">

                            <div class="d-flex gap-2 flex-column align-items-center abd-logo col-lg-2 col-md-6 col-6">
                                <a href="https://insiconsulting.com/" target="_blank"><img class="w-100" src="assets/img/insic.png" alt=""></a>
                            </div>
                            <div class="col-lg-2 d-flex flex-column align-items-center gap-2  col-md-6 col-6">
                                <h3 class="text-center">{!! trans('welcome.sponsored_by') !!}</h3>
                                <div class="w-100 h-fit widget widget-about">
                                    <a href="https://leaderscamp.ma/" target="_blank"><img class="w-75 m-auto" src="assets/img/LC.png" alt=""></a>
                                </div>
                            </div>
                            <div class="col-lg-4 d-flex flex-column align-items-center  col-md-6 col-12">
                                <div class="w-100 h-fit widget widget-about">
                                    <a href="/" target="_blank"><img class="w-75 m-auto" src="assets/img/logo.svg" alt=""></a>
                                </div>
                            </div>
                            <div class="col-lg-2 d-flex flex-column align-items-center gap-2 col-md-6 col-6">
                                <h3 class="text-center">{!! trans('welcome.sponsored_by') !!}</h3>
                                <div class="w-100 h-fit widget widget-about">
                                    <a href="https://www.youtube.com/@TAQASOM.Podcast" target="_blank"><img class="w-75 m-auto" src="assets/img/taqasom.png" alt=""></a>
                                </div>
                            </div>


                            <div class="gap-2 insic  d-flex flex-column align-items-center  col-lg-2  col-md-6 col-6">
                                <h3 class="text-center">تحت اشراف:</h3>
                                <a href="https://www.instagram.com/mr.abdessamad/" class="d-flex" target="_blank"><img class="w-100" src="assets/img/abd-logo.png" alt=""></a>
                            </div>
                        </div>
                    </div><!--top-footer end-->
                    <div class="bottom-footer">
                        <div class="row align-items-center text-sm justify-content-between">
                            <div class="col-lg-4  d-flex gap-4">
                                <p>{{ __('nav.produced_by') }} <a href="conceptify.pro">Conceptify</a></p>
                                {{-- <p>© Copyrights 2025 INSIC All rights reserved</p> --}}
                            </div>
                            <div class="col-lg-4 ">
                                {{-- <p>Produced by: <a href="conceptify.pro">Conceptify</a></p> --}}
                                <p>{!! trans('nav.copyright') !!}</p>
                            </div>
                            <div class="col-lg-4 d-flex gap-4 justify-content-end text-decoration-underline">
                                <p><a href="{{ route('privacy-policy')}}">{{ __('nav.privacy') }}</a></p>
                                {{-- <p><a href="conceptify.pro">Terms of use</a></p> --}}
                            </div>
                            <!-- <div class="col-lg-4 text-center">
                                <ul class="social-links">
                                    <li><a target="_blank" href="#" title="Neuralbox Facebook account"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a target="_blank" href="https://www.youtube.com/@TAQASOM.Podcast" title="Neuralbox Youtube channel"><i class="fab fa-youtube"></i></a></li>
                                    <li><a target="_blank" href="https://www.instagram.com/neuralbox/" title="Neuralbox Instagram account"><i class="fab fa-instagram"></i></a></li>
                                </ul>
                            </div> -->
                        </div>
                    </div><!--bottom-footer end-->
                </div>
            </footer><!--footer end-->
            @endif
            <!--back to top begin-->
            <!-- <button class="back-to-top">
				<i class="fas fa-arrow-up"></i>
			</button> -->
            <!--back to top end-->

        </div>

        <div id="popup-payment" class="popup-overlay">
            <div class="popup-content position-relative p-4">
                <span role="button" class="close position-absolute top-0 p-1 translate-x-middle end-0">×</span>
                <h3 class="title">اشترك الآن لمشاهدة هذا الفيديو</h3>
                <a class="btn-default text-xl ps-4 py-2 h-auto " href="{{ route('payment.form') }}">اشترك الآن</a>
            </div>
        </div>
        <div id="popup-login" class="popup-overlay">
            <div class="popup-content position-relative p-4">
                <span role="button" class="close position-absolute top-0 p-1 translate-x-middle end-0">×</span>
                <h3 class="title">اشترك الآن لمشاهدة هذا الفيديو</h3>
                <a class="btn-default text-xl ps-4 py-2 h-auto " href="{{ route('login') }}">اشترك الآن</a>
            </div>
        </div>

        <div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content flex-row-reverse overflow-hidden rounded-4 border-0 shadow-lg">
                    <div class="modal-body p-0">
                        <div class="auth-container d-flex flex-nowrap">
                            <div class="auth-slide login-slide p-4 p-md-5 d-flex flex-column justify-content-center">
                                <div class="d-flex justify-content-end mb-3">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <h2 class="mb-4 fw-bold text-center">تسجيل الدخول إلى نيورال بوكس</h2>

                                <div class="d-grid mb-3">
                                    <a href="{{ route('google.login') }}" class="btn btn-outline-dark social-btn py-2">
                                        <svg class="social-icon " style="width:1rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512">
                                            <path fill="currentColor" d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z" />
                                        </svg>
                                        الدخول باستخدام جوجل
                                    </a>
                                </div>

                                <div class="divider text-muted small my-4">أو استخدم بريدك الإلكتروني</div>

                                <form class="login-form" action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="email" class="form-control form-control-lg" placeholder="البريد الإلكتروني" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" class="form-control form-control-lg" placeholder="كلمة المرور" name="password" required>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <a href="{{ route('password.request') }}" class="text-decoration-none">هل نسيت كلمة المرور؟</a>
                                    </div>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary btn-lg rounded-pill fw-bold">تسجيل الدخول</button>
                                    </div>
                                </form>
                            </div>

                            <div class="auth-slide register-slide p-4 p-md-5 d-flex flex-column justify-content-center">
                                <div class="d-flex justify-content-end mb-3">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <h2 class="mb-4 fw-bold text-center">إنشاء حساب</h2>

                                <div class="d-grid mb-3">
                                    <a href="{{ route('google.login') }}" class="btn btn-outline-dark social-btn py-2">
                                        <svg class="social-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512">
                                            <path fill="currentColor" d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z" />
                                        </svg>
                                        التسجيل باستخدام جوجل
                                    </a>
                                </div>

                                <div class="divider text-muted small my-4">أو استخدم بريدك الإلكتروني للتسجيل</div>

                                <form action="{{ route('register') }}" class="row" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="text" class="form-control form-control-lg" placeholder="الاسم" required name="name" value="{{ old('name') }}">
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" class="form-control form-control-lg" placeholder="البريد الالكتروني" required name="email" value="{{ old('email') }}">
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" class="form-control form-control-lg" placeholder="كلمة المرور" name="password" required>
                                    </div>
                                    <div class="mb-4">
                                        <input type="password" class="form-control form-control-lg" placeholder="تأكيد كلمة المرور" name="password_confirmation" required>
                                    </div>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary btn-lg rounded-pill fw-bold">إنشاء حساب</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer bg-primary h-auto position-relative welcome-bg d-none d-lg-flex justify-content-between p-5">
                        <div class="text-white text-center auth-welcome login-welcome">
                            <h2 class="welcome-title fw-bold">أهلاً بك مرة أخرى!</h2>
                            <p class="welcome-text mb-4">لتبقى على اتصال معنا، يرجى تسجيل الدخول باستخدام معلومات حسابك.</p>
                            <button class="btn btn-light rounded-pill px-4 py-2 fw-bold switch-form" data-target="login">تسجيل الدخول</button>
                        </div>

                        <div class="text-white text-center auth-welcome register-welcome d-none">
                            <h2 class="welcome-title fw-bold">مرحباً!</h2>
                            <p class="welcome-text mb-4">أدخل معلوماتك الشخصية وابدأ رحلتك معنا.</p>
                            <button class="btn btn-light rounded-pill px-4 py-2 fw-bold switch-form" data-target="register">إنشاء حساب</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- <script src="assets/js/bootstrap/bootstrap.min.js"></script> -->
        <script src="assets/js/isotope.js"></script>
        <script src="assets/js/html5lightbox.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <script src="assets/js/tweenMax.js"></script>
        <script src="assets/js/wow.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
        
        <script src="{{ asset('assets/js/scripts.js') }}"></script>
        <script>
            $(document).ready(function() {
                // Handle form submission for both login and register forms
                $('.register-slide form').on('submit', function(e) {
                    e.preventDefault(); // Stop the default form submission

                    const form = $(this);
                    const url = form.attr('action');
                    const method = form.attr('method');
                    const formData = form.serialize();

                    // Clear previous error messages
                    form.find('.invalid-feedback').remove();
                    form.find('.is-invalid').removeClass('is-invalid');

                    $.ajax({
                        type: method,
                        url: url,
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.success) {
                                // Handle successful submission
                                alert(response.redirect);
                                window.location.href = response.redirect; // Redirect the user
                            } else {
                                // Handle other non-validation errors (e.g., login failed)
                                alert(response.message);
                            }
                        },
                        error: function(xhr) {
                            // Handle validation or other errors
                            if (xhr.status === 422) { // Laravel validation status code
                                const errors = xhr.responseJSON.errors;
                                $.each(errors, function(field, messages) {
                                    const input = form.find('[name="' + field + '"]');
                                    input.addClass('is-invalid');
                                    messages.forEach(function(message) {
                                        const errorHtml = `<div class="invalid-feedback d-block">${message}</div>`;
                                        input.after(errorHtml);
                                    });
                                });
                            } else {
                                // Handle other error codes
                                alert('An error occurred: ' + xhr.statusText);
                            }
                        }
                    });
                });
                $('.login-slide form').on('submit', function(e) {
                    e.preventDefault(); // Stop the default form submission

                    const form = $(this);
                    const url = form.attr('action');
                    const method = form.attr('method');
                    const formData = form.serialize();

                    // Clear previous error messages
                    form.find('.invalid-feedback').remove();
                    form.find('.is-invalid').removeClass('is-invalid');

                    $.ajax({
                        type: method,
                        url: url,
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.success) {
                                // Handle successful submission
                                // alert(response.redirect);
                                window.location.href = response.redirect; // Redirect the user
                            } else {
                                // Handle other non-validation errors (e.g., login failed)
                                alert(response.message);
                            }
                        },
                        error: function(xhr) {
                            // Handle validation or other errors
                            if (xhr.status === 422) { // Laravel validation status code
                                const errors = xhr.responseJSON.errors;
                                $.each(errors, function(field, messages) {
                                    const input = form.find('[name="' + field + '"]');
                                    input.addClass('is-invalid');
                                    messages.forEach(function(message) {
                                        const errorHtml = `<div class="invalid-feedback d-block">${message}</div>`;
                                        input.after(errorHtml);
                                    });
                                });
                            } else {
                                // Handle other error codes
                                alert('An error occurred: ' + xhr.statusText);
                            }
                        }
                    });
                });
            });

            document.addEventListener('DOMContentLoaded', function() {

                const authModal = document.getElementById('authModal');
                const authContainer = authModal.querySelector('.auth-container');
                const loginWelcome = authModal.querySelector('.login-welcome');
                const registerWelcome = authModal.querySelector('.register-welcome');

                // Set initial state
                authContainer.classList.add('login-active');
                loginWelcome.classList.add('d-none');
                registerWelcome.classList.remove('d-none');

                // Add event listeners to the switch buttons
                document.querySelectorAll('.switch-form').forEach(button => {
                    button.addEventListener('click', function() {

                        const target = this.getAttribute('data-target');

                        if (target === 'login') {
                            console.log(target);
                            authContainer.classList.remove('register-active');
                            authContainer.classList.add('login-active');

                            loginWelcome.classList.add('d-none');
                            registerWelcome.classList.remove('d-none');
                        } else if (target === 'register') {
                            authContainer.classList.remove('login-active');
                            authContainer.classList.add('register-active');

                            loginWelcome.classList.remove('d-none');
                            registerWelcome.classList.add('d-none');
                        }
                    });
                });
            });
        </script>

</body>

</html>