@extends('layouts.app')

@section('title', 'نيورال بوكس | دليل نيورال بوكس')

@section('content')

<div class="container payment-form py-5">
    <div class="card shadow-lg border-0 mx-auto rounded-4" style="max-width: 650px;">
        <div class="card-header text-primary lead text-center py-md-4 py-2 rounded-top-4">
            <h2 class="card-title mb-1 fw-bold">{!! trans("payment.continue_payment") !!}</h2>
        </div>

        <form action="{{ route('payment.process') }}" method="post" class="needs-validation" novalidate>
            @csrf
            <div class="card-body p-md-4 p-2">

                @if ($errors->any())
                    <div class="alert alert-danger border-0 shadow-sm mb-4 text-end" dir="rtl">
                        <ul class="mb-0 list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li><i class="fas fa-exclamation-circle ms-2"></i> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-4">
                    <h3 class="h5 mb-3 d-flex align-items-center text-secondary">
                        <i class="fas fa-box-open me-2 text-primary"></i> {!! trans('payment.pack') !!}
                    </h3>
                   <select id="payment-type" name="pack" class="form-select form-select-lg shadow-sm @error('pack') is-invalid @enderror">
    <option value="golden" data-price="3200" {{ old('pack', $pack) == 'golden' ? 'selected' : '' }}>
        الباقة الذهبية - 3200 MAD
    </option>
    <option value="silver" data-price="2300" {{ old('pack', $pack) == 'silver' ? 'selected' : '' }}>
        نيورال بوكس - 2300 MAD
    </option>
</select>
                </div>

                <div class="mb-4">
                    <h3 class="h5 mb-3 d-flex align-items-center text-secondary">
                        <i class="fas fa-user me-2 text-primary"></i> {!! trans('payment.delivery_address') !!}
                    </h3>

                    <div class="mb-3 text-end" dir="rtl">
                        <label class="form-label fw-semibold">{!! trans('payment.full_name') !!}</label>
                        <input type="text" name="full_name" value="{{ old('full_name', Auth::user()->name ?? '') }}" class="form-control form-control-lg shadow-sm @error('full_name') is-invalid @enderror" placeholder="{!! trans('payment.full_name_placeholder') !!}" required>
                    </div>

                    <div class="mb-3 text-end" dir="rtl">
                        <label class="form-label fw-semibold">{!! trans('payment.phone') !!}</label>
                        <input type="tel" name="phone" value="{{ old('phone', Auth::user()->numero ?? '') }}" class="form-control form-control-lg shadow-sm @error('phone') is-invalid @enderror" placeholder="{!! trans('payment.phone_placeholder') !!}" required>
                    </div>

                    <div class="mb-3 text-end" dir="rtl">
                        <label class="form-label fw-semibold">{!! trans('payment.email') !!}</label>
                        <input type="email" name="email" value="{{ old('email', Auth::user()->email ?? '') }}" class="form-control form-control-lg shadow-sm @error('email') is-invalid @enderror" placeholder="{!! trans('payment.email_placeholder') !!}" required>
                    </div>

                    @guest
                    <div class="row">
                        <div class="col-md-6 mb-3 text-end" dir="rtl">
                            <label class="form-label fw-semibold">{!! trans('payment.password') !!}</label>
                            <input type="password" id="password" name="password" class="form-control form-control-lg shadow-sm @error('password') is-invalid @enderror" placeholder="********" required>
                            <div id="pass-len-msg" class="small mt-1 text-muted">8 أحرف على الأقل</div>
                        </div>
                        <div class="col-md-6 mb-3 text-end" dir="rtl">
                            <label class="form-label fw-semibold">{!! trans('payment.password_confirmation') !!}</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-lg shadow-sm" placeholder="********" required>
                            <div id="pass-match-msg" class="small mt-1 text-muted">يجب أن تكون متطابقة</div>
                        </div>
                    </div>
                    @endguest

                    <div class="mb-3 text-end" dir="rtl">
                        <label class="form-label fw-semibold">{!! trans('payment.city') !!}</label>
                        <select name="city" class="form-select form-select-lg shadow-sm @error('city') is-invalid @enderror">
                            <option value="">{!! trans('payment.city_placeholder') !!}</option>
                            @php $selectedCity = old('city', Auth::user()->ville ?? ''); @endphp
                            <option value="tanger" {{ $selectedCity == 'tanger' ? 'selected' : '' }}>طنجة</option>
                            <option value="casablanca" {{ $selectedCity == 'casablanca' ? 'selected' : '' }}>الدار البيضاء</option>
                            <option value="rabat" {{ $selectedCity == 'rabat' ? 'selected' : '' }}>الرباط</option>
                            <option value="marrakech" {{ $selectedCity == 'marrakech' ? 'selected' : '' }}>مراكش</option>
                            <option value="Autre" {{ $selectedCity == 'Autre' ? 'selected' : '' }}>غير ذلك</option>
                        </select>
                    </div>

                    <div class="mb-3 text-end" dir="rtl">
                        <label class="form-label fw-semibold">{!! trans('payment.address') !!}</label>
                        <input type="text" name="address" value="{{ old('address', Auth::user()->rue ?? '') }}" class="form-control form-control-lg shadow-sm @error('address') is-invalid @enderror" placeholder="{!! trans('payment.address_placeholder') !!}">
                    </div>
                </div>

                <input type="hidden" name="payment_option" value="COD">

                <div class="d-flex justify-content-between align-items-center border-top pt-3 mt-4">
                    <small class="text-muted">{{ __('payment.price') }}</small>
                    <span class="h4 fw-bold text-dark" id="amount-display">3200 د.م</span>
                </div>

                <button type="submit" id="payment-button" class="btn btn-primary btn-lg w-100 mt-4 shadow-sm rounded-pill" disabled>
                    <i class="fas fa-lock me-2"></i>{{ __('payment.process') }}
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const payButton = document.getElementById('payment-button');
    const packSelect = document.querySelector('select[name="pack"]');
    const amountDisplay = document.getElementById('amount-display');
    const passwordField = document.getElementById('password');
    const passwordConfirmField = document.getElementById('password_confirmation');
    const lenMsg = document.getElementById('pass-len-msg');
    const matchMsg = document.getElementById('pass-match-msg');

    const requiredInputs = [
        document.querySelector('input[name="full_name"]'),
        document.querySelector('input[name="phone"]'),
        document.querySelector('input[name="email"]'),
        packSelect
    ];

    function updateAmount() {
        const price = packSelect.options[packSelect.selectedIndex].dataset.price;
        amountDisplay.innerText = price + " د.م";
    }

    function checkForm() {
        let allFilled = requiredInputs.every(f => f && f.value.trim() !== '');
        
        if(passwordField && passwordConfirmField){
            const pass = passwordField.value;
            const conf = passwordConfirmField.value;

            // Validation Visuelle Longueur
            if(pass.length >= 8) {
                lenMsg.className = "small mt-1 text-success fw-bold";
                lenMsg.innerHTML = "✓ تم قبول طول كلمة المرور";
            } else if(pass.length > 0) {
                lenMsg.className = "small mt-1 text-danger";
                lenMsg.innerHTML = "✗ يجب أن تكون 8 أحرف على الأقل";
            }

            // Validation Visuelle Correspondance
            if(conf.length > 0) {
                if(pass === conf) {
                    matchMsg.className = "small mt-1 text-success fw-bold";
                    matchMsg.innerHTML = "✓ كلمات المرور متطابقة";
                } else {
                    matchMsg.className = "small mt-1 text-danger";
                    matchMsg.innerHTML = "✗ كلمات المرور غير متطابقة";
                }
            }

            allFilled = allFilled && pass.length >= 8 && pass === conf;
        }
        
        payButton.disabled = !allFilled;
    }

    document.querySelectorAll('input, select').forEach(el => {
        el.addEventListener('input', checkForm);
    });

    packSelect.addEventListener('change', updateAmount);

    updateAmount();
    checkForm();
});
</script>

@endsection