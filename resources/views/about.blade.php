@extends('layouts.app')

@section('title', 'نيورال بوكس | من نحن')

@section('content')
<link rel="stylesheet" href="{{ asset('css/about.css') }}">
<section class="about-hero bg-white w-100 position-relative  p-5">
    <div class=" row my-0 px-2 justify-content-between flex-wrap align-items-center py-0 mx-auto">

        <div class=" col-7 mb-2 mb-md-0 ps-0 px-md-2 py-md-4">
            <h1 class=" fs-1 text-white  fw-bold">من نحن؟</h1>
            <p class="text-white text-center fs-5 px-2 lh-base">
                {!! trans('about.description') !!}
            </p>
        </div>
        <div class="col-5 slider-container">
            <div class="abt-carousel">
                @for ($i = 1; $i <= 16; $i++)

                    <div class="img-container">
                    <img class="shadow" src="{{ asset('assets/img/slide/'.$i.'.webp') }}" alt="Neuralbox carousels images">
            </div>
            @endfor

        </div>
    </div>

    </div>

    <svg class="hero-wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 60" preserveAspectRatio="none">
        <path fill="#fff" d="M0,0 C280,60 720,0 1440,60 L1440,60 L0,60 Z"></path>
    </svg>
</section>

<section class="mission-section mw-75">

    <div class="cccontainer">
        <!-- <div class="lg:max-w-2xl max-w-5xl "> -->
        <h2 class="section-title">{{ __('about.values_title') }}:</h2>
        <p class="ccontainer">تشكل قيمنا الأساس الذي نبني عليه جميع قراراتنا وخدماتنا، وهي تعكس التزامنا العميق تجاه عملائنا وشركائنا:</p>
        <div class="mission-container mw-75">
            <div class="mission-card">
                <h3 class="mission-title">{{ __('about.values.first_title') }}:</h3>
                <p class="mission-text">
                    {{ __('about.values.first_description') }}
                </p>
            </div>

            <div class="mission-card">
                <h3 class="mission-title">{{ __('about.values.second_title') }}:</h3>
                <p class="mission-text">
                    {{ __('about.values.second_description') }}
                </p>
            </div>

            <div class="mission-card">
                <h3 class="mission-title">{{ __('about.values.third_title') }}:</h3>
                <p class="mission-text">
                    {{ __('about.values.third_description') }}
                </p>
            </div>
            <div class="mission-card">
                <h3 class="mission-title">{{ __('about.values.four_title') }}:</h3>
                <p class="mission-text">
                    {{ __('about.values.four_description') }}
                </p>
            </div>
        </div>
    </div>
</section>

<section id="services" class="services-section">
    <div class="cccontainer">
        <h2 class="services-title"> {{ __('about.speciality_title') }}:</h2>
        <p class="services-subtitle">{{ __('about.speciality_description') }}</p>

        <div class="services-grid">
            <div class="mission-card">
                <h3 class="service-title1"> {{ __('about.speciality.first_title') }}:</h3>
                <p class="service-description">{{ __('about.speciality.first_description') }}</p>
            </div>

            <div class="mission-card">
                <h3 class="service-title11">{{ __('about.speciality.second_title') }}:</h3>
                <p class="service-description">{{ __('about.speciality.second_description') }}</p>
            </div>

            <div class="mission-card">


                <h3 class="service-title1">{{ __('about.speciality.third_title') }}:</h3>
                <p class="service-description">{{ __('about.speciality.third_description') }}</p>

            </div>

            <div class="mission-card">
                <h3 class="service-title1">{{ __('about.speciality.four_title') }}:</h3>
                <p class="service-description">{{ __('about.speciality.four_description') }}</p>
            </div>

        </div>
    </div>
</section>

@endsection
@section('footer','footer')