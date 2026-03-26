<!DOCTYPE html> 
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>إعادة تعيين كلمة المرور</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
</head>
<body>

    <div class="background-shape-top"></div>
    <div class="background-shape-bottom"></div>

    <div class="login-container">
        <div class="signin-section">
            <div class="logo" style="color: rgb(26, 32, 219);">
<a href="{{ url('/') }}" class="logo">
    <img src="{{ asset('assets/img/logo.png') }}" alt="NeuralBox Logo" style="height: 60px;">
</a>            </div>

            <h1>إعادة تعيين كلمة المرور</h1>

            <form method="POST" action="{{ route('password.email') }}" class="login-form">
                @csrf
                <div class="form-group">
                    <input
                        type="email"
                        name="email"
                        placeholder="بريدك الإلكتروني"
                        required
                        class="form-control"
                        value="{{ old('email') }}"
                        autofocus
                    >
                    @error('email')
                        <div class="text-red-600 text-sm" style="margin-top: 0.25rem;">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn" style="width: 100%; margin-top: 1rem;">
                    إرسال رابط إعادة التعيين
                </button>
            </form>
        </div>

        <div class="welcome-section">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>

           <h2 class="welcome-title">مرحباً بكم!</h2>
<p class="welcome-text">أدخلوا بريدكم الإلكتروني لتصلكم رسالة إعادة التعيين.</p>
            <a href="{{ route('register') }}" class="signup-btn">إنشاء حساب</a>
        </div>
    </div>

</body>
</html>
