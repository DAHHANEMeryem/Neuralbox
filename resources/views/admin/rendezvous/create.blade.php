@extends('layouts.app')

@section('content')
<style>
    /* Alert styles */
    .alert {
      padding: 15px;
      margin-bottom: 20px;
      border-radius: 8px;
      font-weight: 500;
    }
    
    .alert-success {
      background-color: #d4edda;
      border: 1px solid #c3e6cb;
      color: #155724;
    }

    /* Styles spécifiques à cette page */
    .appointment-wrapper {
      min-height: 80vh;
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
      /* Compense les marges du container Bootstrap si présent */
    }

    .appointment-container {
      background: #fff;
      padding: 30px 40px;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.15);
      width: 100%;
      max-width: 60%;
    }

    .appointment-container h1 {
      text-align: center;
      margin-bottom: 25px;
      color: #2575fc;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .appointment-form {
      display: flex;
      flex-direction: column;
      gap: 18px;
    }

    .appointment-form .form-group {
      display: flex;
      flex-direction: column;
    }

    .appointment-form label {
      font-weight: 600;
      margin-bottom: 6px;
      color: #444;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .appointment-form input, 
    .appointment-form select, 
    .appointment-form textarea {
      padding: 12px 14px;
      font-size: 1rem;
      border: 2px solid #ddd;
      border-radius: 8px;
      transition: border-color 0.3s;
      width: 100%;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .appointment-form input{
           direction: rtl;
    }

    .appointment-form input:focus, 
    .appointment-form select:focus, 
    .appointment-form textarea:focus {
      border-color: #2575fc;
      outline: none;
      box-shadow: 0 0 0 3px rgba(37, 117, 252, 0.1);
    }

    .appointment-form textarea {
      resize: vertical;
      min-height: 80px;
    }

    .appointment-form .btn-submit {
      background: #2575fc;
      color: white;
      font-weight: 700;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s, transform 0.2s;
      border-radius: 8px;
      padding: 12px 14px;
      font-size: 1rem;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .appointment-form .btn-submit:hover {
      background: #1b52d4;
      transform: translateY(-1px);
    }

    .appointment-form .btn-submit:active {
      transform: translateY(0);
    }

    .form-note {
      font-size: 0.85rem;
      color: #666;
      margin-top: 5px;
      font-style: italic;
    }

    /* Responsive design */
    @media (max-width: 768px) {
      .appointment-wrapper {
        padding: 10px;
        margin: -10px;
      }
      
      .appointment-container {
        padding: 20px 25px;
      }
    }
</style>
<div class="appointment-wrapper">
  <div class="appointment-container">
    <h1>حجز موعد</h1>
    
    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <form class="appointment-form" method="POST" action="{{ route('rendezvous.store') }}">
      @csrf
      
      <div class="form-group">
        <label for="email">البريد الإلكتروني</label>
        <input type="email" id="email" name="email" placeholder="مثال@Gmail.com" 
               value="{{ old('email') }}" required />
        @error('email')
          <span class="form-note" style="color: #e74c3c;">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="numero">رقم الهاتف</label>
        <input type="text" id="numero" name="numero" placeholder="+33 6 12 34 56 78" 
               value="{{ old('numero') }}" maxlength="20" required />
        @error('numero')
          <span class="form-note" style="color: #e74c3c;">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="message">الرسالة</label>
        <input type="text" id="message" name="message" placeholder="اكتب رسالتك ..." />
        @error('message')
          <span class="form-note" style="color: #e74c3c;">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="date">تاريخ ووقت الموعد</label>
        <input type="datetime-local" id="date" name="date" value="{{ old('date') }}" required />
        <span class="form-note">يرجى اختيار تاريخ ووقت في المستقبل</span>
        @error('date')
          <span class="form-note" style="color: #e74c3c;">{{ $message }}</span>
        @enderror
      </div>

      <button type="submit" class="btn-submit">طلب الموعد</button>
    </form>
  </div>
</div>
@endsection
