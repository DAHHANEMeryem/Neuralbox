@extends('layouts.app')

@section('title', 'نورال بوكس | نجح الاشتراك')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
<style>
    .success-container {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        font-family: 'Cairo', sans-serif;
    }
    
    .welcome-card {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        border-radius: 15px;
        padding: 40px;
        text-align: center;
        margin-bottom: 30px;
    }
    
    .welcome-icon {
        width: 100px;
        height: 100px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        animation: bounce 2s infinite;
    }
    
    .welcome-icon i {
        font-size: 50px;
    }
    
    @keyframes bounce {
        0%, 20%, 60%, 100% { transform: translateY(0); }
        40% { transform: translateY(-20px); }
        80% { transform: translateY(-10px); }
    }
    
    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin: 30px 0;
    }
    
    .feature-card {
        background: white;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s;
    }
    
    .feature-card:hover {
        transform: translateY(-5px);
    }
    
    .feature-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(45deg, #28a745, #20c997);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
    }
    
    .feature-icon i {
        color: white;
        font-size: 24px;
    }
    
    .btn-start {
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
        border: none;
        padding: 15px 40px;
        border-radius: 25px;
        text-decoration: none;
        display: inline-block;
        font-size: 18px;
        font-weight: bold;
        margin: 20px 10px;
        transition: transform 0.3s;
    }
    
    .btn-start:hover {
        transform: translateY(-2px);
        color: white;
        text-decoration: none;
    }
    
    .upgrade-section {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 25px;
        text-align: center;
        margin-top: 30px;
    }
</style>
@endsection

@section('content')
<div class="success-container">
    <div class="welcome-card">
        <div class="welcome-icon">
            <i class="fas fa-rocket"></i>
        </div>
        <h1>مرحباً بك في نيورال بوكس!</h1>
        <p style="font-size: 18px; margin-bottom: 0;">تم تفعيل باقة الانطلاق المجانية بنجاح</p>
    </div>
    
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-play-circle"></i>
            </div>
            <h5>ابدأ التعلم</h5>
            <p>اكتشف المحتوى التعليمي المتاح في باقة الانطلاق</p>
        </div>
        
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-book-open"></i>
            </div>
            <h5>دروس تفاعلية</h5>
            <p>مجموعة من الدروس المصممة خصيصاً لطفلك</p>
        </div>
        
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <h5>تتبع التقدم</h5>
            <p>راقب تطور طفلك مع تقارير دورية</p>
        </div>
        
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-headset"></i>
            </div>
            <h5>دعم فني</h5>
            <p>فريقنا متاح لمساعدتك في أي وقت</p>
        </div>
    </div>
    
    <div class="text-center">
        <a href="{{ route('dashboard') }}" class="btn-start">
            <i class="fas fa-tachometer-alt"></i>
            ابدأ رحلة التعلم
        </a>
        
        <a href="{{ route('home') }}" class="btn-start" style="background: linear-gradient(45deg, #28a745, #20c997);">
            <i class="fas fa-home"></i>
            العودة للرئيسية
        </a>
    </div>
    
    <div class="upgrade-section">
        <h4><i class="fas fa-crown text-warning"></i> هل تريد المزيد؟</h4>
        <p>ترقية إلى الباقة الذهبية أو باقة نيورال بوكس للحصول على:</p>
        <ul style="list-style: none; padding: 0;">
            <li><i class="fas fa-check text-success"></i> محتوى تعليمي شامل ومتقدم</li>
            <li><i class="fas fa-check text-success"></i> جلسات فردية مع المختصين</li>
            <li><i class="fas fa-check text-success"></i> تقارير مفصلة عن تطور الطفل</li>
            <li><i class="fas fa-check text-success"></i> دعم مباشر على مدار الساعة</li>
        </ul>
        
        <a href="{{ route('subscriptions.index') }}" class="btn btn-warning btn-lg mt-3">
            <i class="fas fa-arrow-up"></i>
            ترقية الاشتراك
        </a>
    </div>
</div>
@endsection