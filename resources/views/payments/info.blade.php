 @extends('layouts.app')

 @section('title', 'نيورال بوكس | دليل نيورال بوكس')

 @section('content')

 <div class="container payment-form py-5">
     <div class="card shadow-lg border-0 mx-auto rounded-4" style="max-width: 650px;">
         <!-- Header -->
         <div class="card-header text-primary  lead text-center py-md-4 py-2 rounded-top-4">
             <h2 class="card-title mb-1 fw-bold">{!! trans("payment.continue_payment") !!}</h2>
             {{-- <p class="card-subtitle lead text-white-50">Complétez votre inscription à Neural Box</p> --}}
         </div>

         <form action="{{ route('payment.process') }}" enctype="multipart/form-data" method="post" class="needs-validation" novalidate>
             @csrf
             <div class="card-body p-md-4 p-2">

                 <div class="mb-4">
                     <h3 class="h5 mb-3 d-flex align-items-center text-secondary">
                         <i class="fas fa-box-open me-2 text-primary"></i> {!! trans('payment.pack') !!}
                     </h3>
                     <select id="payment-type" name="pack" class="form-select form-select-lg shadow-sm @error('pack') is-invalid @enderror">
                         <option value="golden" price="3200">{!! trans('transelt.title2') !!} - 3200 {!! trans('payment.mad') !!}</option>
                         <option value="neuralbox" price="2300">{!! trans('transelt.title3') !!} - 2300 {!! trans('payment.mad') !!}</option>
                     </select>
                 </div>

                 <!-- Payment Method -->
                 <div class="mb-4">
                     <h3 class="h5 mb-3 d-flex align-items-center text-secondary">
                         <i class="fas fa-wallet me-2 text-primary"></i> {!! trans('payment.type') !!}
                     </h3>
                     <div class="d-flex gap-3 payment_options flex-row  flex-md-wrap">
                         <input type="radio" class="btn-check" value="card" name="payment_option" id="payment_option" checked>
                         <label class="btn btn-outline-primary px-4 py-2 rounded-pill shadow-sm" for="payment_option">
                             <i class="fas fa-credit-card me-2"></i> {!! trans('payment.card') !!}
                         </label>

                         <input type="radio" class="btn-check" value="transfer" name="payment_option" id="payment_option-2">
                         <label class="btn btn-outline-primary px-4 py-2 rounded-pill shadow-sm" for="payment_option-2">
                             <i class="fas fa-university me-2"></i> {!! trans('payment.virement') !!}
                         </label>
                     </div>
                     @error('payment_option')
                     <div class="alert alert-danger mt-2">{{ $message }}</div>
                     @enderror
                 </div>

                 <!-- Card Details -->
                 <div id="carte-details" class="card card-body border-0 shadow-sm rounded-3 mt-3">
                     <div class="mb-3">
                         <label for="card-number" class="form-label">{{ __("payment.card_number") }}</label>
                         <div class="input-group">
                             <input name="card-number" type="text" id="card-number" class="form-control" placeholder="1234 5678 9012 3456" maxlength="19">
                             <span class="input-group-text bg-light"><i class="fab fa-cc-visa text-primary"></i></span>
                         </div>
                     </div>
                     <div class="mb-3">
                         <label for="card_name" class="form-label">{{ __("payment.card_holder_name") }}</label>
                         <input name="card_name" type="text" id="card_name" class="form-control" placeholder="{{ __('payment.card_holder_name') }}">
                     </div>
                     <div class="row">
                         <div class="col-md-6 mb-3">
                             <label for="card_expiry" class="form-label">{{ __("payment.card_expedation_date") }}</label>
                             <input type="month" name="card_expiry" id="card_expiry" class="form-control">
                         </div>
                         <div class="col-md-6 mb-3">
                             <label for="card_cvv" class="form-label">{{ __("payment.card_security_code") }}</label>
                             <div class="input-group">
                                 <input name="card_cvv" type="text" id="card_cvv" class="form-control" placeholder="123" maxlength="4">
                                 <span class="input-group-text bg-light">
                                     <i class="fas fa-question-circle text-muted" data-bs-toggle="tooltip" title="Le code se trouve au dos de votre carte."></i>
                                 </span>
                             </div>
                         </div>
                     </div>
                 </div>

                 <!-- Transfer Details -->
                 <div id="virement-details" class="card card-body border-0 shadow-sm rounded-3 mt-3 d-none">
                     <h4 class="card-title h6 mb-3 fw-bold text-primary">{{ __("payment.bank_info") }}</h4>
                     <ul class="list-unstyled small">
                         <li><strong>{{ __('payment.bank') }}:</strong> Banque Populaire</li>
                         <li><strong>{{ __('payment.beneficiary') }}:</strong> NEURAL BOX</li>
                         <li><strong>{!! trans('payment.rib') !!}:</strong> 123 456 789 1011 1213 1415</li>
                         <li><strong>{!! trans('payment.iban') !!}:</strong> MA123456789101112131415</li>
                         <li><strong>{!! trans('payment.swift') !!}:</strong> BCPOMAMC</li>
                     </ul>
                     <p class="text-muted small">{{ __("payment.virement_notion") }}</p>
                     <div class="mt-3">
                         <label for="file" class="file-label form-label ">{{ __("payment.receipt") }}</label>
                         <input type="file" name="receipt" id="file" class="form-control">
                         @error('receipt')
                         <div class="alert alert-danger mt-2">{{ $message }}</div>
                         @enderror
                     </div>
                 </div>

                 <!-- Total -->
                 <div class="d-flex justify-content-between align-items-center border-top pt-3 mt-4">
                     <small class="text-muted">{{ __('payment.price') }}</small>
                     <span class="h4 fw-bold text-dark" id="amount-display">3200 د.م</span>
                 </div>

                 <!-- Button -->
                 @if (Auth::check())
                 <button type="submit" class="btn text-white disabled btn-primary btn-lg w-100 mt-4 shadow-sm rounded-pill" id="payment-button">
                     <i class="fas fa-lock me-2"></i>{{ __("payment.process") }}
                 </button>
                 @else
                 <a class="btn btn-secondary btn-lg w-100 mt-4  disabled-payment shadow-sm rounded-pill " type="button" data-bs-toggle="modal" data-bs-target="#authModal" id="payment-button-disable">
                     <i class="fas fa-lock me-2 "></i>{{ __("payment.process") }}
                 </a>
                 @endif

             </div>
         </form>
     </div>
 </div>


 <script>
     document.addEventListener('DOMContentLoaded', function() {
         const paymentType = document.getElementById('payment-type');
         const cvv = document.getElementById('card_cvv');


         document.getElementById('card-number')?.addEventListener('input', function(e) {
             let value = e.target.value.replace(/\s+/g, '');
             if (value.length > 0) {
                 value = value.match(new RegExp('.{1,4}', 'g')).join(' ');
             }
             e.target.value = value;

             // Update card icon. Note: The icon is now inside an input-group-text span
             const cardIcon = document.querySelector('#carte-details .input-group-text i');
             if (value.startsWith('4')) {
                 cardIcon.className = 'fab fa-cc-visa';
             } else if (/^5[1-5]/.test(value)) {
                 cardIcon.className = 'fab fa-cc-mastercard';
             } else if (/^3[47]/.test(value)) {
                 cardIcon.className = 'fab fa-cc-amex';
             } else {
                 cardIcon.className = 'fas fa-credit-card';
             }
         });

         // Format CVV to accept only numbers
         cvv?.addEventListener('input', function(e) {
             e.target.value = e.target.value.replace(/[^\d]/g, '');
         });

         // --- Payment Method Selection ---
         const options = document.querySelectorAll('.payment_options input');
         const details = {
             card: document.getElementById('carte-details'),
             //  paypal: document.getElementById('paypal-details'),
             transfer: document.getElementById('virement-details'),
         };
         const payButton = document.getElementById('payment-button');
         const stepIndicators = document.querySelectorAll('.d-flex.justify-content-between.align-items-center > div');

         let selectedMethod = "card";

         options.forEach(option => {
             option.addEventListener('click', () => {

                 // Remove active styling from all buttons and add to the selected one
                 options.forEach(o => o.classList.remove('active', 'btn-primary'));
                 options.forEach(o => o.classList.add('btn-outline-primary'));
                 option.classList.remove('btn-outline-primary');
                 option.classList.add('active', 'btn-primary');
                 selectedMethod = option.value;

                 // Hide all detail sections and show the selected one using Bootstrap's d-none class
                 for (const key in details) {
                     details[key].classList.add('d-none');
                 }
                 details[selectedMethod].classList.remove('d-none');



                 // Update step indicator
                 stepIndicators.forEach((step, index) => {
                     if (index === 1) {
                         step.classList.remove('opacity-50');
                         step.querySelector('div').classList.remove('bg-light', 'text-dark');
                         step.querySelector('div').classList.add('bg-primary', 'text-white');
                     }
                 });

                 formValidation();
             });
         });

         paymentType.addEventListener('change', function() {
             const amount = this.value == "golden" ? 3200 : 2300;
             const amountDisplay = document.getElementById('amount-display');
             //  const bankAmount = document.getElementById('bank-amount');

             amountDisplay.innerText = amount + " {{ __('payment.mad') }}"
             //  bankAmount.innerText = amount + ' DH';

             amountDisplay.classList.add('text-primary');
             setTimeout(() => {
                 amountDisplay.classList.remove('text-primary');
             }, 1000);
             formValidation();
         });




         $('#file').on('change', function(element) {
             //  const $label = $('label.file-label');
             //  var fileName = '';
             //  if (element.target.value) fileName = element.target.value.split('\\').pop();
             //  fileName ? $label.addClass('has-file').find('.js-fileName').html(fileName) : $label.removeClass('has-file').html(labelVal);
             formValidation();
         });

         function formValidation() {
             if (selectedMethod == 'card') {
                 const cardNumber = document.getElementById('card-number').value.length;
                 const cardName = document.getElementById('card_name').value.length;
                 const cardExpiry = document.getElementById('card_expiry').value;
                 const cardCvv = document.getElementById('card_cvv').value.length;

                 if ((cardNumber == 19) && (cardName > 4) && cardExpiry && cardCvv == 3)
                     payButton.classList.remove("disabled");
                 else
                     payButton.classList.add("disabled");

             } else {
                 const receipt = document.getElementById('file').value;

                 if (receipt)
                     payButton.classList.remove("disabled");
                 else
                     payButton.classList.add("disabled");
             }
         }

         //  window.submitPayment = function() {

         //      const bacType = document.getElementById('payment-type').value;
         //      if (!bacType) {
         //          alert("Veuillez sélectionner le type de payment.");
         //          document.getElementById('payment-type').focus();
         //          return;
         //      }

         //      if (!selectedMethod) {
         //          alert("Veuillez choisir une méthode de paiement.");
         //          return;
         //      }


         //      if (selectedMethod === 'card') {
         //          const cardNumber = document.getElementById('card-number').value;
         //          const cardName = document.getElementById('card_name').value;
         //          const cardExpiry = document.getElementById('card_expiry').value;
         //          const cardCvv = document.getElementById('card_cvv').value;

         //          if (!cardNumber || !cardName || !cardExpiry || !cardCvv) {
         //              alert("Veuillez remplir tous les champs de paiement par carte.");
         //              return;
         //          }
         //      }


         //      payButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Traitement en cours...';
         //      payButton.disabled = true;


         //      setTimeout(() => {

         //         stepIndicators.forEach((step, index) => {
         //              if (index === 2) {
         //                  step.classList.remove('opacity-50');
         //                  step.querySelector('div').classList.remove('bg-light', 'text-dark');
         //                  step.querySelector('div').classList.add('bg-primary', 'text-white');
         //              }
         //          });

         //          let message = "";
         //          if (selectedMethod === 'card') {
         //              message = "Paiement par carte accepté ! Un email de confirmation va vous être envoyé.";
         //          } else if (selectedMethod === 'paypal') {
         //              message = "Vous allez être redirigé vers PayPal pour finaliser votre paiement de " + bacType + " MAD.";
         //          } else {
         //              message = "Votre demande de paiement par virement de " + bacType + " MAD a été enregistrée. N'oubliez pas d'effectuer le virement dans les 48h.";
         //          }

         //          alert(message);

         //          payButton.innerHTML = '<i class="fas fa-check-circle me-2"></i> Paiement effectué';
         //          payButton.classList.remove('btn-primary');
         //          payButton.classList.add('btn-success');
         //      }, 1500);
         //  };
         /* (function() {
                  var $input = $('#file'),
                      $label = $input.next('.js-labelFile'),
                      labelVal = $label.html();

                  $input.on('change', function(element) {
                      var fileName = '';
                      if (element.target.value) fileName = element.target.value.split('\\').pop();
                      fileName ? $label.addClass('has-file').find('.js-fileName').html(fileName) : $label.removeClass('has-file').html(labelVal);
                  });
         })();*/



     });
 </script>
 @endsection
 @section('footer','footer')