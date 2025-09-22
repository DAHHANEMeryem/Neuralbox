@extends('layouts.app')

@section('title', 'نيورال بوكس | الاشتراكات')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/subscribe.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Amiri&family=Cairo&family=Changa&family=Lalezar&family=Reem+Kufi&family=Noto+Naskh+Arabic&family=Scheherazade+New&family=El+Messiri&family=Markazi+Text&family=Harmattan&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection

@section('content')
<div class="subscription-container">
    <h2 class="text-center mb-5" style="font-weight: bolder; margin:50px;">اشترك الآن وابدأ التعلم</h2>
    <p class="text-center">سجّل الآن واهدي أبناءك صندوق نيورال بوكس، برنامج تربوي وعلاجي شامل مصمم من طرف خبراء لمساعدتك على أن تصبح أنت الأخصائي.</p>

    @if(session('success'))
    <div class="alert alert-success text-center" role="alert">
        {{ session('success') }}
    </div>
    @endif

    @if(session('message'))
    <div class="alert alert-info text-center" role="alert">
        {{ session('message') }}
    </div>
    @endif

    <section class="pricing-page-section">
        <div class="auto-container">
            <div class="row clearfix">
                <!-- باقة الانطلاق -->
                <div class="price-block price-start">
                    <div class="inner-box1 wow fadeInLeft">
                        {!!__('transelt.title1')!!}
                        <div class="price">0<sup>DH</sup></div>
                        {!!__('transelt.ul1')!!}

                        @auth
                        <a href="{{ route('subscription.payment', 'start') }}" class="subscription-btn btn-free">
                            <i class="fas fa-rocket"></i>
                            ابدأ مجاناً
                        </a>
                        @else
                        <a href="{{ route('login') }}" class="subscription-btn btn-free">
                            <i class="fas fa-sign-in-alt"></i>
                            سجل الدخول للبدء
                        </a>
                        @endauth
                    </div>
                </div>

                <!-- الباقة الذهبية -->
                <div class="price-block price-gold">
                    <div class="ribbon-wrapper">
                        <div class="ribbon-label">الاكثر طلبا!</div>
                    </div>
                    <div class="inner-box1 wow fadeInUp">
                        {!!__('transelt.title2')!!}
                        <div class="price">3200<sup>DH</sup></div>
                        {!!__('transelt.ul2')!!}

                        @auth
                        <a href="{{ route('subscription.payment', 'gold') }}" class="subscription-btn btn-gold">
                            <i class="fas fa-crown"></i>
                            اشترك الآن
                        </a>
                        @else
                        <a href="{{ route('login') }}" class="subscription-btn btn-gold">
                            <i class="fas fa-sign-in-alt"></i>
                            سجل الدخول للاشتراك
                        </a>
                        @endauth
                    </div>
                </div>

                <!-- باقة نيورال بوكس -->
                <div class="price-block price-nouralbox">
                    <div class="inner-box1 wow fadeInRight">
                        {!!__('transelt.title3')!!}
                        <div class="price">2300<sup>DH</sup></div>
                        {!!__('transelt.ul3')!!}

                        @auth
                        <a href="{{ route('subscription.payment', 'nouralbox') }}" class="subscription-btn btn-nouralbox">
                            <i class="fas fa-box"></i>
                            اشترك الآن
                        </a>
                        @else
                        <a href="{{ route('login') }}" class="subscription-btn btn-nouralbox">
                            <i class="fas fa-sign-in-alt"></i>
                            سجل الدخول للاشتراك
                        </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section d'avantages -->
    <section class="benefits-section mt-5">
        <div class="container">
            <h3 class="text-center mb-4">لماذا تختار نيورال بوكس؟</h3>
            <div class="row">
                <div class="col-md-4 text-center mb-3">
                    <i class="fas fa-brain fa-3x text-primary mb-3"></i>
                    <h5>تطوير الذكاء</h5>
                    <p>برامج علمية مثبتة لتطوير قدرات الطفل الذهنية</p>
                </div>
                <div class="col-md-4 text-center mb-3">
                    <i class="fas fa-users fa-3x text-success mb-3"></i>
                    <h5>إشراف خبراء</h5>
                    <p>فريق من المختصين في التربية وعلم النفس</p>
                </div>
                <div class="col-md-4 text-center mb-3">
                    <i class="fas fa-chart-line fa-3x text-warning mb-3"></i>
                    <h5>متابعة التقدم</h5>
                    <p>تقارير دورية لمتابعة تطور طفلك</p>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    .subscription-btn {
        display: inline-block;
        padding: 12px 30px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: bold;
        transition: all 0.3s ease;
        margin-top: 20px;
        text-align: center;
        color: white;
    }

    .btn-free {
        background: linear-gradient(45deg, #28a745, #20c997);
    }

    .btn-gold {
        background: linear-gradient(45deg, #ffc107, #ff8c00);
    }

    .btn-nouralbox {
        background: linear-gradient(45deg, #007bff, #6610f2);
    }

    .subscription-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        color: white;
        text-decoration: none;
    }

    .benefits-section {
        background: #f8f9fa;
        padding: 50px 0;
        border-radius: 15px;
    }

    .alert {
        border-radius: 10px;
        margin-bottom: 30px;
    }

    .ribbon-wrapper {
        position: absolute;
        top: 10px;
        right: -5px;
        z-index: 1;
    }

    .ribbon-label {
        background: #ff6b6b;
        color: white;
        padding: 5px 15px;
        border-radius: 15px 0 15px 0;
        font-size: 12px;
        font-weight: bold;
    }
</style>
@endsection