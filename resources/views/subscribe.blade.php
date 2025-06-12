@extends('layouts.app')
 
@section('title', 'نورال بوكس | الرئيسية')
 
@section('styles')
<link rel="stylesheet" href="{{ asset('css/subscribe.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Amiri&family=Cairo&family=Changa&family=Lalezar&family=Reem+Kufi&family=Noto+Naskh+Arabic&family=Scheherazade+New&family=El+Messiri&family=Markazi+Text&family=Harmattan&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection

@section('content')
<div class="subscription-container">
    <h2 class="text-center mb-5 "style="  font-weight: bolder; margin:50px;">اشترك الآن وابدأ التعلم</h2>
    <p class="text-center">سجّل الآن واهدي أبناءك صندوق نيورال بوكس، برنامج تربوي وعلاجي شامل مصمم من طرف خبراء لمساعدتك على أن تصبح أنت الأخصائي.</p>
    
    <section class="pricing-page-section">
        <div class="auto-container">
            <div class="row clearfix">
                <!-- باقة الانطلاق -->
                <div class="price-block price-start">
                    <div class="inner-box1 wow fadeInLeft">
                        {!!__('transelt.title1')!!}
                        <div class="price">0<sup>DH</sup></div>
                        {!!__('transelt.ul1')!!}
                        {!!__('transelt.a9')!!}
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
                        {!!__('transelt.a10')!!}
                    </div>
                </div>
                
                <!-- باقة نيورال بوكس -->
                <div class="price-block price-nouralbox">
                    <div class="inner-box1 wow fadeInRight">
                        {!!__('transelt.title3')!!}
                        <div class="price">2300<sup>DH</sup></div>
                        {!!__('transelt.ul3')!!}
                        {!!__('transelt.a10')!!}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
