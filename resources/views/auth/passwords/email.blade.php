<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>استرجاع كلمة المرور - نيورال بوكس</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
</head>

<body>

    <div class="background-shape-top"></div>
    <div class="background-shape-bottom"></div>

    <div class="login-container">
        <div class="signin-section">
            <div class="logo" style="color: rgb(26, 32, 219);">
                <a href="{{ url('/') }}" class="logo-text1" style="color:rgb(11, 29, 221); text-decoration: none;">الرئيسية</a>
            </div>

            <h1>استرجاع كلمة المرور</h1>

            @if (session('status'))
            <div class="mb-4 text-green-600" style="text-align:center; margin-bottom:1rem;">
                {{ session('status') }}
            </div>
            @endif

            <form class="login-form" method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group">
                    <input
                        id="email"
                        type="email"
                        name="email"
                        class="form-control"
                        placeholder="البريد الإلكتروني"
                        required
                        autofocus
                        value="{{ old('email') }}">
                    @error('email')
                    <div class="text-red-600 text-sm" style="margin-top:0.25rem;">{{ $message }}</div>
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

            <h2 class="welcome-title">!مرحبا</h2>
            <p class="welcome-text">ادخل بريدك الإلكتروني وسنرسل لك رابط استعادة كلمة المرور</p>
            <a href="{{ route('register') }}" class="signup-btn">انشاء حساب</a>
        </div>
    </div>

</body>

</html>