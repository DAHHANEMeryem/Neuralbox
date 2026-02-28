@extends('layouts.app')

@section('title', 'نيورال بوكس | دليل نيورال بوكس')

@section('content')

<div class="container payment-form py-5">
    <div class="card shadow-lg border-0 mx-auto rounded-4" style="max-width: 650px;">
        <!-- Header -->
        <div class="card-header text-primary lead text-center py-md-4 py-2 rounded-top-4">
            <h2 class="card-title mb-1 fw-bold">{!! trans("payment.continue_payment") !!}</h2>
        </div>

        <form action="{{ route('payment.process') }}" method="post" class="needs-validation" novalidate>
            @csrf
            <div class="card-body p-md-4 p-2">

                <!-- Pack Selection -->
                <div class="mb-4">
                    <h3 class="h5 mb-3 d-flex align-items-center text-secondary">
                        <i class="fas fa-box-open me-2 text-primary"></i> {!! trans('payment.pack') !!}
                    </h3>
                    <select id="payment-type" name="pack" class="form-select form-select-lg shadow-sm @error('pack') is-invalid @enderror">
                        <option value="golden" data-price="3200">{!! trans('transelt.title2') !!} - 3200 {!! trans('payment.mad') !!}</option>
                        <option value="silver" data-price="2300">{!! trans('transelt.title3') !!} - 2300 {!! trans('payment.mad') !!}</option>
                    </select>
                </div>

                <!-- Payment Method -->
                <div class="mb-4">
                    <h3 class="h5 mb-3 d-flex align-items-center text-secondary">
                        <i class="fas fa-wallet me-2 text-primary"></i> {!! trans('payment.type') !!}
                    </h3>
                    <div class="d-flex gap-3 payment_options flex-row flex-md-wrap">
                        <input type="radio" class="btn-check" value="COD" name="payment_option" id="payment_option_cod" checked>
                        <label class="btn btn-outline-primary px-4 py-2 rounded-pill shadow-sm" for="payment_option_cod">
                            <i class="fas fa-money-bill-wave me-2"></i> {!! trans('payment.COD') !!}
                        </label>
                    </div>
                    @error('payment_option')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Customer Information -->
                <div class="mb-4">
                    <h3 class="h5 mb-3 d-flex align-items-center text-secondary">
                        <i class="fas fa-user me-2 text-primary"></i> {!! trans('payment.delivery_address') !!}
                    </h3>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">{!! trans('payment.full_name') !!}</label>
                        <input type="text" name="full_name" class="form-control form-control-lg shadow-sm" placeholder="{!! trans('payment.full_name_placeholder') !!}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">{!! trans('payment.phone') !!}</label>
                        <input type="tel" name="phone" class="form-control form-control-lg shadow-sm" placeholder="{!! trans('payment.phone_placeholder') !!}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">{!! trans('payment.email') !!}</label>
                        <input type="email" name="email" class="form-control form-control-lg shadow-sm" placeholder="{!! trans('payment.email_placeholder') !!}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">{!! trans('payment.city') !!}</label>
                        <select name="city" class="form-select form-select-lg shadow-sm">
                            <option value="">{!! trans('payment.city_placeholder') !!}</option>
                            <option value="tanger">طنجة</option>
                            <option value="casablanca">الدار البيضاء</option>
                            <option value="rabat">الرباط</option>
                            <option value="marrakech">مراكش</option>
                            <option value="Autre">غير ذلك</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">{!! trans('payment.address') !!}</label>
                        <input type="text" name="address" class="form-control form-control-lg shadow-sm" placeholder="{!! trans('payment.address_placeholder') !!}">
                    </div>

                    <!-- Total -->
                    <div class="d-flex justify-content-between align-items-center border-top pt-3 mt-4">
                        <small class="text-muted">{{ __('payment.price') }}</small>
                        <span class="h4 fw-bold text-dark" id="amount-display">{{ $amount }} د.م</span>
                    </div>
                </div>

                <!-- Button -->
                @if (Auth::check())
                    <button type="submit" id="payment-button" class="btn btn-primary btn-lg w-100 mt-4 shadow-sm rounded-pill" disabled>
                        <i class="fas fa-lock me-2"></i>{{ __('payment.process') }}
                    </button>
                @else
                    <a href="javascript:void(0)" class="btn btn-secondary btn-lg w-100 mt-4 shadow-sm rounded-pill disabled" data-bs-toggle="modal" data-bs-target="#authModal">
                        <i class="fas fa-lock me-2"></i>{{ __('payment.process') }}
                    </a>
                @endif

            </div>
        </form>
    </div>
</div>

<!-- JS fonctionnel -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    const payButton = document.getElementById('payment-button');
    const packSelect = document.querySelector('select[name="pack"]');
    const amountDisplay = document.getElementById('amount-display');

    // Champs obligatoires
    const requiredFields = [
        document.querySelector('input[name="full_name"]'),
        document.querySelector('input[name="phone"]'),
        document.querySelector('input[name="email"]'),
        packSelect
    ];

    function updateAmount() {
        if (!packSelect) return;
        const selectedOption = packSelect.options[packSelect.selectedIndex];
        const price = selectedOption.dataset.price;
        if(amountDisplay) {
            amountDisplay.innerText = price + " د.م";
        }
    }

    function checkForm() {
        const allFilled = requiredFields.every(field => field && field.value.trim() !== '');
        if(payButton) {
            payButton.disabled = !allFilled;
        }
    }

    // Événements
    if(packSelect) {
        packSelect.addEventListener('change', () => {
            updateAmount();
            checkForm();
        });
    }

    requiredFields.forEach(field => {
        if(field) {
            field.addEventListener('input', checkForm);
            field.addEventListener('change', checkForm);
        }
    });

    // Initialisation
    updateAmount();
    checkForm();
});
</script>







@endsection
@section('footer','footer')
