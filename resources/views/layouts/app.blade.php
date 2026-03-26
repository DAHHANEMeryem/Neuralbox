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

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css')}}">


    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css')}}">
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap/bootstrap.css')}}"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css')}}">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('navData')

    <style>
        /* Navbar plus petite */
.navigation-bar{
    padding: -10px ;
}

.logo img{
    height: 80px;
    width: auto;
}
/* Menu plus compact */
.navigation-bar nav ul li a{
    font-size: 14px;
    padding: 5px 10px;
}

/* Réduit l'espace autour du menu */
.navigation-bar nav{
    padding-left: 20px !important;
    padding-right: 20px !important;
    margin-left: 20px !important;
    margin-right: 20px !important;
}

/* Cache le logo mobile par défaut sur desktop */
.logo-mobile {
    display: none;
}

/* --- Styles Mobile UNIQUEMENT --- */
@media (max-width: 768px) {
    
    /* 1. Force le masquage de la navbar desktop sur mobile */
    .navigation-bar {
        display: none !important;
    }

    /* 2. Style du conteneur du logo centré */
    .logo-mobile-centered {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%); /* C'est le secret du centrage parfait */
        z-index: 1000; /* Assure qu'il est au-dessus du reste */
       
    
    }

   /* 3. Agrandissement du Logo */
.logo-mobile-centered img {
 height: 100px !important; /* Teste avec 100px pour bien voir la différence */
    width: auto !important;
    max-height: none !important; /* Parfois
}
    /* 4. Ajustement du bouton menu pour qu'il ne colle pas au bord */
    .menu-btn.margin-menu-mobile {
        margin: 0;
        z-index: 1001; /* Doit être au-dessus du logo pour rester cliquable */
    }

    /* Gère la marge du bouton menu selon la direction du site (LTR ou RTL) */
    [dir="ltr"] .menu-btn.margin-menu-mobile {
        margin-right: auto; /* Pousse le bouton vers la gauche en LTR */
    }

    [dir="rtl"] .menu-btn.margin-menu-mobile {
        margin-left: auto; /* Pousse le bouton vers la droite en RTL */
    }
}

    </style>

</head>

<body dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">


    <div class="wrapper" @hasSection('background') style="background: @yield('background')" @endif>

        <div class="main-section" @hasSection('background') style="background:url('');height: inherit;backdrop-filter: blur(5rem);" @endif>
        
<header>
    <!-- Mobile Header -->
    <div class="d-md-none position-relative d-flex align-items-center px-3" style="min-height: 80px; background-color: white;">
        <div class="menu-btn">
            <a href="javascript:void(0)">
                <span class="bar1"></span>
                <span class="bar2"></span>
                <span class="bar3"></span>
            </a>
        </div>
        <div class="logo-mobile-centered">
            <a href="{{ route('home') }}">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo NeuralBox" style="height: 50px; width: auto;">
            </a>
        </div>
    </div>

    <!-- Desktop Header -->
    <div class="container d-none d-md-block">
        <div @class(["navigation-bar d-flex justify-content-center align-items-center", $navTheme ?? ' '])>
            <div class="logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
                </a>
            </div>
            
            <nav class="border-start border-end border-2 px-5 mx-5">
                <ul class="d-flex list-unstyled mb-0">
                    @if(Auth::check() && Auth::user()->is_admin)
                        <li>
                            <a class="{{(Route::current()->getName() === 'admin.dashboard') ? 'active' : ''}}" href="{{ route('admin.dashboard') }}">
                                {{ __("nav.admin_dashboard") }}
                            </a>
                        </li>
                    @endif
                    <li><a class="{{(Route::current()->getName() === 'home') ? 'active' : ''}}" href="{{ route('home') }}">{{ __("nav.home") }}</a></li>
                    <li><a class="{{(Route::current()->getName() === 'neuralbox') ? 'active' : ''}}" href="{{ route('neuralbox') }}">{{ __("nav.neural-guide") }}</a></li>
                    <li><a class="{{(Route::current()->getName() === 'peda') ? 'active' : ''}}" href="{{ route('peda') }}">{{ __("nav.peda") }}</a></li>
                    <li><a class="{{(Route::current()->getName() === 'suivre') ? 'active' : ''}}" href="{{ route('suivre') }}">{{ __("nav.suivre") }}</a></li>
                    <li><a class="{{(Route::current()->getName() === 'about') ? 'active' : ''}}" href="{{ route('about') }}">{{ __("nav.about") }}</a></li>
                </ul>
            </nav>

            <nav>
                <ul class="d-flex list-unstyled mb-0 align-items-center">
                    @if(!Auth::check() || !Auth::user()->subscription_type)
                        <li class="shadow-primary-lg py-1 px-4 rounded-4 me-3" style="background-color: #775b9f;">
    <a class="text-white" href="{{ url('/') }}#pricing-two">
        {{ __("nav.pricing") }}
    </a>
</li>
                         
                    @endif

                    @auth
                        <li>
                            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">@csrf</form>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('nav.logout') }}
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#authModal">{{ __("nav.login") }}</a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</header>

<!-- Responsive Menu -->
<div class="responsive-menu">
    <ul>
        @if(Auth::check() && Auth::user()->is_admin)
            <li>
                <a class="{{(Route::current()->getName() === 'admin.dashboard') ? 'active' : ''}}" href="{{ route('admin.dashboard') }}">
                    {{ __("nav.admin_dashboard") }}
                </a>
            </li>
        @endif
        <li><a class="{{(Route::current()->getName() === 'home') ? 'active' : ''}}" href="{{ route('home') }}">{{ __("nav.home") }}</a></li>
        <li><a class="{{(Route::current()->getName() === 'neuralbox') ? 'active' : ''}}" href="{{ route('neuralbox') }}">{{ __("nav.neural-guide") }}</a></li>
        <li><a class="{{(Route::current()->getName() === 'peda') ? 'active' : ''}}" href="{{ route('peda') }}">{{ __("nav.peda") }}</a></li>
        <li><a class="{{(Route::current()->getName() === 'suivre') ? 'active' : ''}}" href="{{ route('suivre') }}">{{ __("nav.suivre") }}</a></li>
        <li><a class="{{(Route::current()->getName() === 'about') ? 'active' : ''}}" href="{{ route('about') }}">{{ __("nav.about") }}</a></li>
        @if(!Auth::check() || !Auth::user()->subscription_type)
            <li><a href="{{ route('payment.form') }}">{{ __("nav.pricing") }}</a></li>
        @endif

        @auth
            <li>
                <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">@csrf</form>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('nav.logout') }}
                </a>
            </li>
        @else
            <li><a href="" data-bs-toggle="modal" data-bs-target="#authModal" id="payment-button-disable">{{ __("nav.login") }}</a></li>
        @endif
    </ul>
</div>
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
<div class="social-icons d-flex justify-content-center justify-content-md-start gap-3">
    <a href="https://www.facebook.com/people/NeuralBox/61578444458954/?mibextid=wwXIfr&rdid=4RY5VJj6sHt6XgNR&share_url=https%3A%2F%2Fwww.facebook.com%2Fshare%2F18KdjnFeba%2F%3Fmibextid%3DwwXIfr" target="_blank" class="fs-1"><i class="fab fa-facebook rounded-circle"></i></a>
    <a href="https://www.instagram.com/neuralbox/" target="_blank" class="fs-1"><i class="fab fa-instagram"></i></a>
    <a target="_blank" class="fs-1"><i class="fab fa-youtube"></i></a>
</div>                        </div>
                        <div class="col-md-3 order-1 align-items-start d-flex">

                            <img class="mx-auto foot-logo p-md-3" src="{{ asset('assets/img/logo-white.png') }}" alt="" srcset="">
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
                                {{-- <p>Produced by: <a href="https://conceptify.pro/">Conceptify</a></p> --}}
                                <p>{!! trans('nav.copyright') !!}</p>
                            </div>
                            <div class="col-md-4 order-1 order-md-2 col-6 d-flex gap-4 justify-content-center text-decoration-underline">
                                <p><a href="{{ route('privacy-policy')}}">{{ __('nav.privacy') }}</a></p>
                                {{-- <p><a href="conceptify.pro">Terms of use</a></p> --}}
                            </div>
                            <div class="col-md-4 order-1 order-md-3 col-6 justify-content-end d-flex gap-4">
                                <p>{{ __('nav.produced_by') }} <a href="https://conceptify.pro/">Conceptify</a></p>
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
<div class="modal fade overflow-hidden video-learning-modal" id="exampledsModal" tabindex="-1" aria-labelledby="exampledsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 450px;"> <div class="modal-content bg-transparent border-0 shadow-lg position-relative">
            
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" 
                style="position: absolute; right: -10px; top: -40px; z-index: 9999; opacity: 1; filter: brightness(0) invert(1);">
            </button>

            <div class="modal-body p-0">
                <video id="video-player" class="rounded-4" controls width="100%" style="aspect-ratio: 9/16; background: #000;"></video>
                
                @if ("{{ @yield('videoModal') }}" == 'navigation')
                    <button class="prev-btn p-0"></button>
                    <button class="next-btn p-0"></button>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    /* Pour s'assurer que le X est bien visible sur mobile */
    @media (max-width: 576px) {
        #exampledsModal .btn-close {
            right: 10px !important;
            top: 10px !important;
            background-color: rgba(0,0,0,0.5);
            border-radius: 50%;
            padding: 10px;
        }
    }
</style>
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
    <!-- <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js')}}"></script> -->
    <script src="{{ asset('assets/js/isotope.js')}}"></script>
    <script src="{{ asset('assets/js/html5lightbox.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="{{ asset('assets/js/tweenMax.js')}}"></script>
    <script src="{{ asset('assets/js/wow.min.js')}}"></script>

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
<!-- WhatsApp -->
<a href="https://wa.me/212667325757" target="_blank" class="whatsapp-float">
    <img src="{{ asset('assets/img/whatsapp-icon.png') }}" alt="WhatsApp" />
</a>

<!-- Chatbot -->
<div id="chatbot-toggle" class="chatbot-icon">
    <img src="{{ asset('assets/img/chatbot-icon.png') }}" alt="Assistant" />
</div>

<div id="chatbot-box">
    <div id="chat-header">💬 مساعد نيورال بوكس</div>
    <div id="chat-body"><p>مرحباً! كيف يمكنني مساعدتك؟</p></div>
    <input type="text" id="chat-input" placeholder="اكتب رسالتك هنا..." />
</div>

<style>
/* WhatsApp */
.whatsapp-float { position: fixed; bottom: 20px; right: 20px; z-index: 1000; width: 60px; height: 60px; }
.whatsapp-float img { width: 100%; height: 100%; border-radius: 50%; box-shadow: 0 4px 10px rgba(0,0,0,0.2); transition: transform 0.3s; }
.whatsapp-float img:hover { transform: scale(1.1); }

/* Chatbot icône */
.chatbot-icon { position: fixed; bottom: 90px; right: 20px; width: 60px; height: 60px; z-index: 1000; cursor: pointer; }
.chatbot-icon img { width: 100%; height: 100%; border-radius: 50%; box-shadow: 0 4px 10px rgba(0,0,0,0.2); transition: transform 0.3s; }
.chatbot-icon img:hover { transform: scale(1.1); }

/* Chatbot fenêtre */
#chatbot-box { 
    position: fixed; bottom: 160px; right: 20px; width: 250px; background: white; border: 1px solid #ccc; border-radius: 10px; 
    box-shadow: 0 4px 15px rgba(0,0,0,0.2); z-index: 1000; font-family: Arial, sans-serif; display: none; flex-direction: column;
}
#chat-header { background: #4b0082; color: white; padding: 8px; border-top-left-radius: 10px; border-top-right-radius: 10px; cursor: pointer; }
#chat-body { padding: 10px; height: 150px; overflow-y: auto; direction: rtl; color:black;}
#chat-input { width: calc(100% - 16px); margin: 5px 8px 8px 8px; padding: 5px; border-radius: 5px; border: 1px solid #ccc; direction: rtl; text-align: right; }
</style>

<script>
const icon = document.getElementById('chatbot-toggle'); // Utilise le bon ID
const box = document.getElementById('chatbot-box');
const body = document.getElementById('chat-body');
const input = document.getElementById('chat-input');

// Toggle ouverture/fermeture du chatbot
icon.addEventListener('click', () => {
    box.style.display = box.style.display === 'flex' ? 'none' : 'flex';
    box.style.flexDirection = 'column';
});

// Fonction de réponse
function getReply(message) {
    message = message.toLowerCase();

    // Salut / bienvenue
    if(message.includes('مرحبا') || message.includes('سلام') || message.includes('bonjour') || message.includes('salut')) {
        return "مرحباً! أنا مساعد نيورال بوكس. يمكنك طرح أي سؤال.";
    }

    // Prix / السعر
  if(message.includes('prix') || message.includes('السعر') || message.includes('تكلفة') || message.includes('ثمن') || message.includes('الثمن')) {
        return { type: 'redirect', target: '#pricing-two', text: "للاطلاع على الأسعار، اضغط هنا." };
    }

    // Contact / الاتصال
    if(message.includes('contact') || message.includes('numéro') || message.includes('الاتصال') || message.includes('appeler') || message.includes('واتساب') || message.includes('رقم')) {
         return { type: 'redirect', target: '#contact', text:" للاتصال بنا اضغط هنا" };
    }
    

    // Inscription / تسجيل / abonnement
    if(message.includes('inscription') || message.includes('تسجيل') || message.includes('الاشتراك')) {

        // Cas spécifique باقة الإنطلاق
        if(message.includes('باقة الانطلاق') || message.includes('launch pack') || message.includes('pack de lancement')) {
            return "باقة الإنطلاق: ستحصل على الوصول فقط إلى مجتمع نيورال بوكس على التلغرام والمحتوى المجاني.";
        }

        return "بعد التسجيل، ستحصل على الوصول إلى نيورال بوكس مع ألعاب عقلية شهرية، فيديوهات تدريبية، وتتبع شخصي.";
    }

    // Tout autre question
    return " لمزيد من المعلومات، يرجى الاتصال بنا.";
}

// Événement pour envoyer le message
input.addEventListener('keypress', function(e){
    if(e.key === 'Enter' && input.value.trim() !== ''){
        const userMsg = document.createElement('div');
        userMsg.textContent = "👤 " + input.value;
        userMsg.style.margin = '5px 0';
        userMsg.style.textAlign = 'right';
        body.appendChild(userMsg);

        const reply = getReply(input.value);

        const botMsg = document.createElement('div');
        botMsg.style.margin = '5px 0';
        botMsg.style.fontWeight = 'bold';
        botMsg.style.textAlign = 'right';

        if(typeof reply === 'object' && reply.type === 'redirect') {
            botMsg.innerHTML = `🤖 <a href="${reply.target}" style="color:#25d366; text-decoration:underline;">${reply.text}</a>`;
        } else {
            botMsg.textContent = "🤖 " + reply;
        }

        body.appendChild(botMsg);
        body.scrollTop = body.scrollHeight;
        input.value = '';
    }
});
</script>

{{-- Modal qui s'affiche après scroll --}}
<div class="modal fade" id="scrollSubscribeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-purple text-white">
                <h5 class="modal-title fw-bold"><i class="fas fa-star me-2"></i> {{ __('transelt.enjoy_free_content') }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-4">
                <p>{{ __('transelt.subscribe_for_free_content') }}</p>
            </div>
            <div class="modal-footer justify-content-center border-0 pb-4">
                <a href="{{ route('login') }}" class="btn btn-purple px-4 py-2 rounded-pill shadow">
                    {{ __('transelt.subscribe_now') }}
                </a>
                <button type="button" class="btn btn-light px-4 py-2 rounded-pill" data-bs-dismiss="modal">
                    {{ __('transelt.maybe_later') }}
                </button>
            </div>
        </div>
    </div>
</div>
@if(!Auth::check())
<script>
document.addEventListener('DOMContentLoaded', function() {
    let scrollTime = 0; // Temps total passé en scroll (en secondes)
    let lastScroll = Date.now();
    let modalShown = false;

    function showScrollModal() {
        if (!modalShown) {
            const scrollModal = new bootstrap.Modal(document.getElementById('scrollSubscribeModal'));
            scrollModal.show();
            modalShown = true;
        }
    }

    window.addEventListener('scroll', function() {
        if (modalShown) return; // Ne rien faire si modal déjà affiché

        const now = Date.now();
        const delta = (now - lastScroll) / 1000; // temps écoulé depuis le dernier scroll en secondes
        lastScroll = now;

        scrollTime += delta;

        if (scrollTime >= 10) { // 10 secondes cumulées de scroll
            showScrollModal();
        }
    });
});
</script>
@endif

<div class="modal fade" id="contactChoiceModal" tabindex="-1" aria-hidden="true" dir="rtl">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 text-end">

            <!-- Header -->
            <div class="modal-header bg-purple text-white">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-phone-alt ms-2"></i> اختر طريقة التواصل
                </h5>
                <button type="button" class="btn-close btn-close-white ms-0 me-auto" data-bs-dismiss="modal"></button>
            </div>

            <!-- Body -->
            <div class="modal-body text-center p-4">

                <h4 class="fw-bold mb-2">تواصل معنا بسهولة</h4>
                <p class="text-muted mb-4">اختر الطريقة التي تناسبك</p>

                <a id="callBtn" href="#" class="btn btn-light w-100 mb-3 rounded-pill shadow-sm d-flex align-items-center justify-content-center gap-2">
                    <i class="fas fa-phone-alt"></i> اتصال هاتفي
                </a>

                <a id="waBtn" href="#" target="_blank" class="btn btn-success w-100 rounded-pill shadow-sm d-flex align-items-center justify-content-center gap-2">
                    <i class="fab fa-whatsapp"></i> واتساب
                </a>

            </div>

        </div>
    </div>
</div>
<script>
function openContactModal(number) {

    // injecter les liens
    document.getElementById("callBtn").href = "tel:" + number;
    document.getElementById("waBtn").href = "https://wa.me/" + number.replace('+', '');

    // ouvrir modal bootstrap
    let modal = new bootstrap.Modal(document.getElementById('contactChoiceModal'));
    modal.show();
}
</script>

<div class="modal fade" id="progressionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            {{-- Header Violet --}}
            <div class="modal-header text-white border-0" style="background-color: #775b9f;">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-lock me-2"></i> المحتوى مقفل
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body text-center p-4">
                <div class="mb-3">
                    {{-- Icône Violette --}}
                    <i class="fas fa-exclamation-circle fa-4x" style="color: #775b9f;"></i>
                </div>
                
                <h5 class="fw-bold text-dark mb-2">يرجى إكمال الفيديو السابق أولاً</h5>
                <p class="text-muted mb-4">يجب عليك مشاهدة الدروس بالترتيب لضمان أفضل استيعاب للمادة العلمية.</p>
                
                {{-- Bouton Violet --}}
              <button type="button" 
        class="btn text-white w-100 fw-bold py-2 rounded-pill shadow-sm d-flex justify-content-center align-items-center" 
        style="background-color: #775b9f; border: none; transition: opacity 0.3s;"
        onmouseover="this.style.opacity='0.9'" 
        onmouseout="this.style.opacity='1'"
        data-bs-dismiss="modal">
    <span>حسناً</span>
</button>
            </div>
        </div>
    </div>
</div>

<!-- GUIDE MODAL -->
<div class="modal fade" id="guideModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;">
        <div class="modal-content border-0 shadow-lg">

            <!-- HEADER -->
            <div class="modal-header bg-purple text-white">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-book-open me-2"></i> دليل الاستخدام
                </h5>
                <button type="button" class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body p-4 px-5" id="guideContent">

                <!-- contenu dynamique ici -->

            </div>

            <!-- FOOTER -->
            <div class="modal-footer justify-content-center border-0 pb-4">
                <button type="button"
                        class="btn btn-light px-4 py-2 rounded-pill"
                        data-bs-dismiss="modal">
                    حسناً
                </button>
            </div>

        </div>
    </div>
</div>
<style>
    .modal-content {
    border-radius: 15px;
}


    #guideContent {
    direction: rtl;
    text-align: right;
    color: #000; /* texte noir */
    font-size: 15px; /* un peu plus petit */
    line-height: 1.8; /* espace entre lignes */
}

#guideContent p {
    margin-bottom: 12px;
}

#guideContent h4,
#guideContent h5 {
    color: #000;
    margin-bottom: 15px;
}

#guideContent hr {
    margin: 20px 0;
}
</style>

<script>
function openGuideModal(page) {

    let content = '';

    if(page === 'pedagogie') {
        content = `
           <div class="mb-3 text-center">
    <i class="fas fa-graduation-cap fa-3x text-primary"></i>
</div>

            

            <div style="direction: rtl; text-align: center; max-height: 60vh; overflow-y: auto;">
                          <h5 class="fw-bold mb-3">المحتوى التعليمي</h5>

            <p class="mb-2">
                في هذه الصفحة نقدم لكم التكوين العلمي الذي يحتاجه الأمهات والآباء
                لكي ينجحوا في مهمة التربية بكل سلاسة.
            </p>

            <p class="mb-2">
                ينقسم المحتوى إلى 10 مجزوءات تجمع بين النظري والتطبيقي.
            </p>

            <p class="mb-2">
                بعد كل درس، يتم اجتياز اختبار لتقييم المكتسبات.
            </p>

            <p class="mb-2">
                وعند إتمام جميع المجزوءات، ستحصلون على شهادة:
            </p>

            <p class="fw-bold text-primary">
                "أخصائي تربوي بمنهاج نيورال بوكس"
            </p>

            <p>
                موقعة من الكوتش عبد الصمد ومعتمدة من معهد العلوم العصبية.
            </p>
            </div>
        `;
    } 
        else {
    content = `
        <div class="mb-3 text-center">
            <i class="fas fa-brain fa-3x text-warning"></i>
        </div>

        <h4 class="fw-bold mb-3" style="text-align: center;">دليل نيورال بوكس</h4>

        <div style="direction: rtl; text-align: right; max-height: 60vh; overflow-y: auto;">

            <p class="mb-3">
                نيورال بوكس ليس مجرد صندوق ألعاب وإنما هو خطة للعلاج وتطوير الأداء الدراسي والنفسي
                في قالب عائلي يجمع بين المتعة والاستفادة.
            </p>

            <p class="fw-bold">1. لضمان تحقيق أهداف نيورال بوكس:</p>
            <p class="mb-3">
                يجب تحفيز الطفل قبليا لاستقبال الصندوق الخاص به. وفور تسلمه يتم فتحه في جو أسري جماعي إيجابي،
                ويتم اكتشاف الألعاب والوسائل خارجيا فقط دون فتحها.
            </p>

            <p class="fw-bold">2. الحفاظ على القيمة التربوية:</p>
            <p class="mb-3">
                يجب جمع الصندوق مباشرة ووضعه في مكان يصعب ولوجه من طرف الطفل
                (استراتيجية سطل الحلوى في الثقافة المغربية).
            </p>

            <p class="fw-bold">3. نظام الاستعمال الأسبوعي:</p>
            <p class="mb-3">
                مساء كل يوم جمعة، نفتح لعبة جديدة مقابل تسليم اللعبة السابقة مع الحفاظ على نظافتها وسلامتها،
                ويستفيد الطفل من اللعبة الجديدة طيلة الأسبوع.
            </p>

            <p class="fw-bold">4. ترتيب الألعاب:</p>
            <p class="mb-3">
                لا تفتح الألعاب بشكل عشوائي، بل يجب اتباع الترتيب المحدد، حيث تم إعدادها وفق أهداف تربوية
                وعلمية مدروسة.
            </p>

            <p class="fw-bold">5. التتبع والتقييم:</p>
            <p class="mb-4">
                نهاية كل أسبوع، يجب ملأ تقرير سريع والضغط على زر (تم) لفتح المرحلة التالية،
                مع الاستفادة من الشروحات والفيديوهات المرافقة.
            </p>

            <hr>

        </div>
    `;
}
    

    document.getElementById('guideContent').innerHTML = content;

    let modal = new bootstrap.Modal(document.getElementById('guideModal'));
    modal.show();
}
</script>

</body>


</html>