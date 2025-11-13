@extends('layouts.app')

@section('content')
<div class="container my-5" dir="rtl">
  <div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
      <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
          <h2 class="text-center mb-4 fw-bold">حجز موعد</h2>

          {{-- Success message --}}
          @if(session('success'))
          <div class="alert alert-success text-center">
            {{ session('success') }}
          </div>
          @endif

          <form method="POST" action="{{ route('rendezvous.store') }}">
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label fw-semibold">البريد الإلكتروني</label>
              <input type="email" class="form-control rounded-3 @error('email') is-invalid @enderror"
                id="email" name="email" placeholder="مثال@Gmail.com"
                value="{{ old('email') }}" required>
              @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="numero" class="form-label fw-semibold">رقم الهاتف</label>
              <input type="tel" class="form-control rounded-3 @error('numero') is-invalid @enderror"
                id="numero" name="numero" placeholder="+33 6 12 34 56 78"
                value="{{ old('numero') }}" maxlength="20" required>
              @error('numero')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Message -->
            <div class="mb-3">
              <label for="message" class="form-label fw-semibold">الرسالة</label>
              <textarea class="form-control rounded-3 @error('message') is-invalid @enderror"
                id="message" name="message" placeholder="اكتب رسالتك ..." rows="3">{{ old('message') }}</textarea>
              @error('message')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="date" class="form-label fw-semibold">تاريخ ووقت الموعد</label>
              <input type="datetime-local" class="form-control rounded-3 @error('date') is-invalid @enderror"
                id="date" name="date" value="{{ old('date') }}" required>
              <div class="form-text">يرجى اختيار تاريخ ووقت في المستقبل</div>
              @error('date')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Submit -->
            <div class="d-grid mt-4">
              <button type="submit" class="btn btn-primary btn-lg rounded-3">
                <i class="bi bi-calendar-check me-2"></i> طلب الموعد
              </button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('footer','footer')