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
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('navData')
</head>

<body dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">


    <div class="wrapper" @hasSection('background') style="background: @yield('background')" @endif>

        <div class="main-section" @hasSection('background') style="background:url('');height: inherit;backdrop-filter: blur(5rem);" @endif>
            <header>
                <div @class(['header-content justify-content-center py-2 bg-purple d-flex flex-wrap align-items-center',$navTheme ?? ' ' ])>
                    <h3 class="text-center fs-7">{{ __('nav.head_message') }}</h3>
                    <div class="menu-btn">
                            <a href="#">
                                <span class="bar1"></span>
                                <span class="bar2"></span>
                                <span class="bar3"></span>
                            </a>
                        </div>
                </div>
                <div class="container">
                    <div @class(["navigation-bar d-flex justify-content-center align-items-center",$navTheme ?? ' ' ])>
                        <div class="logo">
                            <a href="{{ route('home') }}" title="">
                                <img src="{{ asset('assets/img/logo.png') }}" alt="">
                            </a>
                        </div>
                        
                        <nav class="border-start border-end border-2 px-5 mx-5">
                            <ul>
                                @if(Auth::check() && Auth::user()->is_admin)<li><a class="{{(Route::current()->getName() === 'admin.dashboard') ? 'active' : ''}}" href="{{ route('admin.dashboard') }}" title="">{{ __("nav.admin_dashboard") }}</a></li>@endif
                                <li><a class="{{(Route::current()->getName() === 'home') ? 'active' : ''}}" href="{{ route('home') }}" title="">{{ __("nav.home") }}</a></li>
                                <li><a class="{{(Route::current()->getName() === 'neuralbox') ? 'active' : ''}}" href="{{ route('neuralbox') }}" title="">{{ __("nav.neural-guide") }}</a></li>
                                <li><a class="{{(Route::current()->getName() === 'peda') ? 'active' : ''}}" href="{{ route('peda') }}" title="">{{ __("nav.peda") }}</a></li>
                                <li><a class="{{(Route::current()->getName() === 'suivre') ? 'active' : ''}}" href="{{ route('suivre') }}" title="">{{ __("nav.suivre") }}</a></li>
                                <li><a class="{{(Route::current()->getName() === 'about') ? 'active' : ''}}" href="{{ route('about') }}" title="">{{ __("nav.about") }}</a></li>
                            </ul>
                        </nav>
                        <nav>
                            <ul>
                                @if(!Auth::check() || !Auth::user()->subscription_type)<li class="bg-primary shadow-primary-lg py-1 px-4 rounded-4"><a class="text-white" href="{{ route('payment.form') }}" title="">{{ __("nav.pricing") }}</a></li>@endif
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
                    @if(Auth::check() && Auth::user()->is_admin)<li><a class="{{(Route::current()->getName() === 'admin.dashboard') ? 'active' : ''}}" href="{{ route('admin.dashboard') }}" title="">{{ __("nav.admin_dashboard") }}</a></li>@endif
                    <li><a class="{{(Route::current()->getName() === 'home') ? 'active' : ''}}" href="{{ route('home') }}" title="">{{ __("nav.home") }}</a></li>
                    <li><a class="{{(Route::current()->getName() === 'neuralbox') ? 'active' : ''}}" href="{{ route('neuralbox') }}" title="">{{ __("nav.neural-guide") }}</a></li>
                    <li><a class="{{(Route::current()->getName() === 'peda') ? 'active' : ''}}" href="{{ route('peda') }}" title="">{{ __("nav.peda") }}</a></li>
                    <li><a class="{{(Route::current()->getName() === 'suivre') ? 'active' : ''}}" href="{{ route('suivre') }}" title="">{{ __("nav.suivre") }}</a></li>
                    <li><a class="{{(Route::current()->getName() === 'about') ? 'active' : ''}}" href="{{ route('about') }}" title="">{{ __("nav.about") }}</a></li>
                    @if(!Auth::check() || !Auth::user()->subscription_type)<li><a href="{{ route('payment.form') }}" title="">{{ __("nav.pricing") }}</a></li>@endif

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

            </div>

            @isset($slot)
            {{ $slot }}
            @else
            @yield('content')
            @endisset

            @hasSection('footer')
            <footer>
                    <div class="row bg-purple foot-top">
                        <div class="col-md-3 order-3">
                            <div class="created_by">
                                <h2 class="fs-4 fw-bold">{{ __('hero.created_by') }}</h2>
                                <div class="d-flex gap-2 justify-content-center justify-content-md-start">
                                    <a href="https://insiconsulting.com" target="_blank"><img src="{{ asset('assets/img/partners/insic.png') }}" alt="logo insic" srcset=""></a>
                                    <a href="https://instagram.com/mr.abdessamad" target="_blank"><img src="{{ asset('assets/img/partners/abd.png') }}" alt="logo abdessaamad" srcset=""></a>
                                </div>
                            </div>
                            {{-- <div class="social-icons">
                                <a href="" target="_blank" class="fs-1"><i class="fab fa-facebook rounded-circle"></i></a>
                                <a href="" target="_blank" class="fs-1"><i class="fab fa-instagram"></i></a>
                            </div> --}}
                        </div>
                        <div class="col-md-3 order-1 align-items-start d-flex">

                            <img class="mx-auto foot-logo p-md-3" src="{{ asset('assets/img/logo-white.svg') }}" alt="" srcset="">
                        </div>
                        <div class="col-md-3 d-none d-md-flex">
                            <h6 class="fw-bold fs-3"> {{ __('hero.NeuralBox')}}</h6>
                            <ul>
                                <li><i class="fs-4 fas fa-angle-left"></i><a class="{{(Route::current()->getName() === 'home') ? 'active' : ''}}" href="{{ route('home') }}" title="">{{ __("nav.home") }}</a></li>
                                <li><i class="fs-4 fas fa-angle-left"></i><a class="{{(Route::current()->getName() === 'neuralbox') ? 'active' : ''}}" href="{{ route('neuralbox') }}" title="">{{ __("nav.neural-guide") }}</a></li>
                                <li><i class="fs-4 fas fa-angle-left"></i><a class="{{(Route::current()->getName() === 'peda') ? 'active' : ''}}" href="{{ route('peda') }}" title="">{{ __("nav.peda") }}</a></li>
                                <li><i class="fs-4 fas fa-angle-left"></i><a class="{{(Route::current()->getName() === 'suivre') ? 'active' : ''}}" href="{{ route('suivre') }}" title="">{{ __("nav.suivre") }}</a></li>
                                <li><i class="fs-4 fas fa-angle-left"></i><a class="{{(Route::current()->getName() === 'about') ? 'active' : ''}}" href="{{ route('about') }}" title="">{{ __("nav.about") }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row foot-bottom text-black py-2 align-items-center small justify-content-between">
                            <div class="col-md-4 order-2 order-md-1">
                                {{-- <p>Produced by: <a href="conceptify.pro">Conceptify</a></p> --}}
                                <p>{!! trans('nav.copyright') !!}</p>
                            </div>
                            <div class="col-md-4 order-1 order-md-2 col-6 d-flex gap-4 justify-content-center text-decoration-underline">
                                <p><a href="{{ route('privacy-policy')}}">{{ __('nav.privacy') }}</a></p>
                                {{-- <p><a href="conceptify.pro">Terms of use</a></p> --}}
                            </div>
                            <div class="col-md-4 order-1 order-md-3 col-6 justify-content-end d-flex gap-4">
                                <p>{{ __('nav.produced_by') }} <a href="conceptify.pro">Conceptify</a></p>
                                {{-- <p>© Copyrights 2025 INSIC All rights reserved</p> --}}
                            </div>
                    </div>
            </footer>
            @endif
        </div>

        {{-- popup --}}
        <div class="modal fade" id="subscriptionModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-purple text-white">
                        <h5 class="modal-title fw-bold"><i class="fas fa-lock me-2"></i> {{ __('transelt.premium_content') }}</h5>
                        <button type="button" class="btn-close btn-close-white float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center p-4">
                        <div class="mb-3">
                            <i class="fas fa-crown fa-3x text-warning"></i>
                        </div>
                        <h4 class="fw-bold">{{ __('transelt.subscription_needed_title') }}</h4>
                        <p class="text-muted">{{ __('transelt.subscription_needed_desc') }}</p>
                    </div>
                    <div class="modal-footer justify-content-center border-0 pb-4">
                        <a href="{{ route('home') }}" class="btn btn-purple px-4 py-2 rounded-pill shadow">
                            {{ __('transelt.view_plans') }}
                        </a>
                        <button type="button" class="btn btn-light px-4 py-2 rounded-pill" data-bs-dismiss="modal">
                            {{ __('transelt.maybe_later') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div id="popup-payment" class="popup-overlay">
            <div class="popup-content position-relative p-4">
                <span role="button" class="close position-absolute top-0 p-1 translate-x-middle end-0">×</span>
                <h3 class="title">اشترك الآن لمشاهدة هذا الفيديو</h3>
                <a class="btn-default text-xl ps-4 py-2 h-auto " href="{{ route('payment.form') }}">اشترك الآن</a>
            </div>
        </div> --}}

        <div id="popup-login" class="popup-overlay">
            <div class="popup-content position-relative p-4">
                <span role="button" class="close position-absolute top-0 p-1 translate-x-middle end-0">×</span>
                <h3 class="title">اشترك الآن لمشاهدة هذا الفيديو</h3>
                <a class="btn-default text-xl ps-4 py-2 h-auto " href="{{ route('login') }}">اشترك الآن</a>
            </div>
        </div>

        @hasSection('videoModal')
        <div class="modal fade overflow-hidden video-learning-modal vh-100" id="exampledsModal" tabindex="1" aria-labelledby="exampledsModalLabel" aria-hidden="true">
            <div class="modal-dialog m-auto   modal-xl  modal-dialog-centered">
                <div class="modal-content vh-100 bg-transparent flex-row-reverse   border-0 shadow-lg">
                    <div class="modal-body  overflow-y-auto  p-0">
                        <video id="video-player" class="rounded-4" controls width="100%"></video>
                        @if ("{{ @yield('videoModal') }}" == 'navigation')
                        <button class="prev-btn p-0 "></button>
                        <button class="next-btn p-0 "></button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif


        <div id="global-spinner">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

    </div>

    <div class="modal fade" id="authModal" aria-labelledby="authModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content flex-md-row-reverse flex-col overflow-hidden rounded-4 border-0 shadow-lg">
                <div class="modal-body p-0">
                    <div class="auth-container d-flex flex-md-nowrap flex-column flex-md-row">
                        <div class="auth-slide login-slide p-4 p-md-5 d-flex flex-column justify-content-center">
                            <div class="d-flex justify-content-start mb-md-3">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <h2 class="mb-md-4 mb-2 fw-bold text-center">تسجيل الدخول إلى نيورال بوكس</h2>

                            <div class="d-grid mb-3">
                                <a href="{{ route('google.login') }}" class="btn btn-outline-dark social-btn py-2">
                                    <svg class="social-icon " style="width:1rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512">
                                        <path fill="currentColor" d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z" />
                                    </svg>
                                    الدخول باستخدام جوجل
                                </a>
                            </div>

                            <div class="divider text-muted small my-md-4 my-2">أو استخدم بريدك الإلكتروني</div>

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
                                    <button type="submit" class="btn btn-primary text-white btn-lg rounded-pill fw-bold">تسجيل الدخول</button>
                                </div>
                            </form>
                        </div>

                        <div class="auth-slide register-slide p-4 p-md-5 d-flex flex-column justify-content-center">
                            <div class="d-flex justify-content-start mb-md-3">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <h2 class="mb-md-4 mb-2 fw-bold text-center">إنشاء حساب</h2>

                            <div class="d-grid mb-3">
                                <a href="{{ route('google.login') }}" class="btn btn-outline-dark social-btn py-2">
                                    <svg class="social-icon" style="width:1rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512">
                                        <path fill="currentColor" d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z" />
                                    </svg>
                                    التسجيل باستخدام جوجل
                                </a>
                            </div>

                            <div class="divider text-muted small my-md-4 my-2">أو استخدم بريدك الإلكتروني للتسجيل</div>

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
                                    <button type="submit" class="btn btn-primary text-white btn-lg rounded-pill fw-bold">إنشاء حساب</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-primary h-auto position-relative  welcome-bg  d-lg-flex justify-content-between p-md-5 ">
                    <div class="text-white text-center auth-welcome login-welcome">
                        <h2 class="welcome-title fw-bold">أهلاً بك مرة أخرى!</h2>
                        <p class="welcome-text mb-md-4 md-2">لتبقى على اتصال معنا، يرجى تسجيل الدخول باستخدام معلومات حسابك.</p>
                        <button class="btn btn-light rounded-pill px-md-4 px-3 py-md-2 py-1 fw-bold switch-form" data-target="login">تسجيل الدخول</button>
                    </div>

                    <div class="text-white text-center auth-welcome register-welcome d-none">
                        <h2 class="welcome-title fw-bold">مرحباً!</h2>
                        <p class="welcome-text mb-md-4 md-2">أدخل معلوماتك الشخصية وابدأ رحلتك معنا.</p>
                        <button class="btn btn-light rounded-pill px-md-4 px-3 py-md-2 py-1 fw-bold switch-form" data-target="register">إنشاء حساب</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
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
    @yield('scripts')
</body>

</html>