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
                <a href="{{ url('/') }}" class="logo-text1" style="color:rgb(11, 29, 221); text-decoration: none;">الرئيسية</a>
            </div>

            <h1 class="text-center mb-6">إعادة تعيين كلمة المرور</h1>

            @if (session('message'))
                <div class="mb-4 text-red-600 text-sm text-center font-medium">
                    {{ session('message') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}" class="login-form">
                @csrf
                @method('PUT')
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group mb-4">
                    <label for="email" class="block mb-1">البريد الإلكتروني</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $email) }}" required autofocus
                        class="form-control" />
                    @error('email')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="password" class="block mb-1">كلمة المرور الجديدة</label>
                    <input id="password" type="password" name="password" required class="form-control" />
                    @error('password')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="password_confirmation" class="block mb-1">تأكيد كلمة المرور</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required class="form-control" />
                </div>

                <button type="submit" class="btn bg-green-600 hover:bg-green-700 text-white w-full py-2 rounded">
                    إعادة التعيين
                </button>
            </form>
        </div>

        <div class="welcome-section">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>

            <h2 class="welcome-title">مرحبا!</h2>
            <p class="welcome-text">أدخل بريدك الإلكتروني وكلمة المرور الجديدة لإعادة تعيين كلمة المرور.</p>
            <a href="{{ route('login') }}" class="signup-btn">تسجيل الدخول</a>
        </div>

    </div>

</body>
</html>
