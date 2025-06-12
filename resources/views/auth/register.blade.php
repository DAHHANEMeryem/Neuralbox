<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">

</head>
<body>
    <div class="background-shape-top"></div>
    <div class="background-shape-bottom"></div>

    <div class="signup-container">
        <div class="logo" style="color: rgb(26, 32, 219);">
                
            <a href="{{ url('/') }}" class="logo-text1" style="color:rgb(252, 253, 255); text-decoration: none;">الرئيسية</a>
            </div>

        <div class="signup-form-section">
            <h1>!انشاء حساب </h1>

            <div class="social-login">
                
              <a href="{{ route('google.login') }}" class="social-btn">
                <svg class="social-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512">
                    <path fill="currentColor" d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"/>
                </svg>
            </a>
                
            </div>

            <div class="divider">:او استخدم  بريدك الالكتروني للتسجيل</div>

            <form action="{{ route('register') }}" method="POST">
              @csrf
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="الاسم" required name="name" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="البريد الالكتروني" required name="email" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="المدينة" required name="ville" value="{{ old('ville') }}">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="الشارع" required name="rue" value="{{ old('rue') }}">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="الرمز البريدي" required name="code_postal" value="{{ old('code_postal') }}">
                </div>
                <div class="form-group">
                    <input type="numero" class="form-control" placeholder="رقم الهاتف" name="numero" required value="{{ old('numero') }}">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" placeholder="كلمة المرور" name="password" required>
              </div>
              <div class="form-group">
                <input type="password" class="form-control" placeholder="تاكيد كلمة المرور" name="password_confirmation" required>
            </div>
           <button type="submit" class="btn">تسجيل الدخول</button>
                
            </form>
        </div>
        <div class="welcome-section">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            
           
            
            <h2 class="welcome-title">!مرحبا بك </h2>
            <p class="welcome-text">للبقاء على تواصل معنا يرجى تسجيل الدخول بمعلوماتك الشخصية</p>
            <a href="{{ route('login') }}" class="signup-btn">تسجيل الدخول </a>
        </div>
    </div>
</body>
</html>