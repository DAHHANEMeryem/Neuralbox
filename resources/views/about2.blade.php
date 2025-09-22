@extends('layouts.app')

@section('title', 'نيورال بوكس | من نحن')

@section('background', 'url(assets/img/call-to-action-banner.jpg)')
@section('nav-white', 'true')
@push('navData')
@php
$navTheme = 'white';
@endphp
@endpush
@section('content')

<!-- Animated Title and Scroll-Triggered Video Section -->
<section class="hero-video-section">
    <div class="title-part">
        <h1 class="hero-title-animated">من نحن؟</h1>
        <p class="hero-description">
            {{ __('about.desc') }}
        </p>
    </div>
    <div class="video-wrapper">
        <video id="about-hero-video" class="about-hero-video" poster="/images/peda/1.png" preload="none" controls muted playsinline>
            <source src="/videos/Tool-1.mp4" type="video/mp4" />
            متصفحك لا يدعم تشغيل الفيديو.
        </video>
    </div>
</section>

@endsection