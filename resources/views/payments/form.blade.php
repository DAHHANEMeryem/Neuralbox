<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>نورال بوكس | الدفع</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
 <style>
        body {
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
        }

        .payment-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .payment-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            padding: 40px;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
        }

        .payment-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #667eea, #764ba2);
        }

        .plan-summary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .plan-summary::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .price-display {
            font-size: 48px;
            font-weight: bold;
            margin: 20px 0;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-control {
            width: 100%;
            border: 2px solid #e1e8ed;
            border-radius: 12px;
            padding: 15px 20px;
            font-size: 16px;
            transition: all 0.3s ease;
            font-family: 'Cairo', sans-serif;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            outline: none;
            transform: translateY(-2px);
        }

        .payment-methods {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 25px;
        }

        .payment-method {
            text-align: center;
            padding: 20px;
            border: 2px solid #e1e8ed;
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
            position: relative;
        }

        .payment-method:hover {
            border-color: #667eea;
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.2);
        }

        .payment-method.active {
            border-color: #667eea;
            background: linear-gradient(135deg, #f8f9ff 0%, #e8f2ff 100%);
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .payment-method.active::after {
            content: '✓';
            position: absolute;
            top: 10px;
            right: 10px;
            background: #667eea;
            color: white;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: bold;
        }

        .payment-method i {
            font-size: 2.5rem;
            margin-bottom: 10px;
            color: #667eea;
        }

        .btn-pay {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 18px 40px;
            border-radius: 30px;
            font-size: 18px;
            font-weight: bold;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-pay:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
        }

        .btn-pay:active {
            transform: translateY(-1px);
        }

        .btn-pay.loading {
            pointer-events: none;
            opacity: 0.8;
        }

        .btn-pay.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid transparent;
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .security-info {
            background: linear-gradient(135deg, #e8f5e8 0%, #f0f8ff 100%);
            border: 1px solid #b6d7ff;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            text-align: center;
            font-size: 14px;
        }

        .security-info i {
            color: #28a745;
            margin-right: 8px;
        }

        .card-element-container {
            border: 2px solid #e1e8ed;
            border-radius: 12px;
            padding: 15px;
            transition: all 0.3s ease;
        }

        .card-element-container:focus-within {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .stripe-element {
            padding: 10px 0;
        }

        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: 8px;
            padding: 10px;
            background: #f8d7da;
            border-radius: 8px;
            border: 1px solid #f5c6cb;
        }

        .alert {
            padding: 15px 20px;
            margin-bottom: 20px;
            border-radius: 12px;
            border: 1px solid transparent;
        }

        .alert-danger {
            background: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .col-md-12 { flex: 1; min-width: 100%; }
        .col-md-6 { flex: 1; min-width: calc(50% - 10px); }

        @media (max-width: 768px) {
            .payment-methods {
                grid-template-columns: 1fr;
            }
            
            .col-md-6 {
                min-width: 100%;
            }
            
            .price-display {
                font-size: 36px;
            }
        }
    </style>
<body>
    <div class="payment-container">
        <div class="plan-summary">
            <h3>{{ $selectedPlan['name'] }}</h3>
            <div class="price-display">
                <span>{{ $selectedPlan['price'] }}</span>
                <sup>DH</sup>
            </div>
            <p>{{ $selectedPlan['description'] }}</p>
        </div>

        <div class="payment-card">
            <h4>
                <i class="fas fa-credit-card"></i>
                معلومات الدفع
            </h4>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('subscription.process') }}" method="POST" id="paymentForm">
                @csrf
                <input type="hidden" name="amount" value="{{ $selectedPlan['price'] }}">
                <input type="hidden" name="plan_type" value="{{ $selectedPlan['slug'] }}">
                <input type="hidden" name="payment_method" id="payment_method" value="credit_card">

                <!-- Méthodes de paiement -->
                <div class="form-group">
                    <label>طريقة الدفع</label>
                    <div class="payment-methods">
                        <div class="payment-method active" data-method="credit_card">
                            <i class="fas fa-credit-card"></i>
                            <div>بطاقة ائتمان</div>
                            <small>Visa, Mastercard</small>
                        </div>
                        <div class="payment-method" data-method="paypal">
                            <i class="fab fa-paypal"></i>
                            <div>PayPal</div>
                            <small>دفع آمن</small>
                        </div>
                        <div class="payment-method" data-method="bank_transfer">
                            <i class="fas fa-university"></i>
                            <div>تحويل بنكي</div>
                            <small>تحقق يدوي</small>
                        </div>
                    </div>
                </div>

                <!-- Informations personnelles -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">البريد الإلكتروني *</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}"
                                   {{ Auth::check() ? '' : 'required' }}>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">رقم الهاتف</label>
                            <input type="tel" class="form-control" id="phone" name="phone"
                                   value="{{ old('phone') }}" placeholder="+212 6XX XXX XXX">
                        </div>
                    </div>
                </div>

                <!-- Champs spécifiques aux cartes de crédit -->
                <div id="credit_card_fields">
                    <div class="form-group">
                        <label for="card_holder_name">اسم حامل البطاقة *</label>
                        <input type="text" class="form-control" id="card_holder_name" name="card_holder_name"
                               value="{{ old('card_holder_name') }}" required>
                    </div>

                    <div class="form-group">
                        <label>معلومات البطاقة *</label>
                        <div class="card-element-container">
                            <div id="card-element" class="stripe-element"></div>
                        </div>
                        <div id="card-errors" class="error-message" style="display: none;"></div>
                    </div>

                    <input type="hidden" name="stripeToken" id="stripeToken">
                </div>

                <div class="security-info">
                    <i class="fas fa-shield-alt"></i>
                    جميع معلوماتك محمية بتشفير SSL. نحن لا نحتفظ بمعلومات البطاقة الائتمانية.
                </div>

                <button type="submit" class="btn-pay">
                    <i class="fas fa-lock"></i>
                    دفع {{ $selectedPlan['price'] }} درهم بأمان
                </button>
            </form>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const stripe = Stripe('pk_test_51RWFyzFaV0XKS5irEj98rGYTFzV6NZlNZXIKu3SFKxeFIqommjxKhK68zUpzwAsfsKlIgJWwJDAsZ33ahe7pUpP600BTK730Le');

            const elements = stripe.elements();
            const style = {
                base: {
                    color: "#32325d",
                    fontFamily: 'Cairo, sans-serif',
                    fontSmoothing: "antialiased",
                    fontSize: "16px",
                    "::placeholder": {
                        color: "#a0aec0"
                    }
                },
                invalid: {
                    color: "#dc3545",
                    iconColor: "#dc3545"
                }
            };

            const card = elements.create("card", { style: style });
            card.mount("#card-element");

            const cardErrors = document.getElementById('card-errors');
            const paymentMethods = document.querySelectorAll('.payment-method');
            const paymentMethodInput = document.getElementById('payment_method');
            const creditCardFields = document.getElementById('credit_card_fields');
            const paymentForm = document.getElementById('paymentForm');
            const btnPay = paymentForm.querySelector('.btn-pay');

            // Gestion de la sélection méthode paiement
            paymentMethods.forEach(method => {
                method.addEventListener('click', () => {
                    paymentMethods.forEach(m => m.classList.remove('active'));
                    method.classList.add('active');
                    paymentMethodInput.value = method.getAttribute('data-method');

                    // Affiche ou cache les champs carte selon méthode
                    if(paymentMethodInput.value === 'credit_card') {
                        creditCardFields.style.display = 'block';
                    } else {
                        creditCardFields.style.display = 'none';
                        cardErrors.style.display = 'none';
                        card.clear();
                    }
                });
            });

            // Au départ, affichage correct selon méthode active
            if(paymentMethodInput.value === 'credit_card') {
                creditCardFields.style.display = 'block';
            } else {
                creditCardFields.style.display = 'none';
            }

            // Gestion validation et token Stripe au submit du formulaire
            paymentForm.addEventListener('submit', async function(e) {
                // Si carte sélectionnée, on génère le token Stripe avant envoi
                if(paymentMethodInput.value === 'credit_card') {
                    e.preventDefault();
                    btnPay.classList.add('loading');
                    btnPay.disabled = true;

                    const cardHolderName = document.getElementById('card_holder_name').value;

                    if(!cardHolderName.trim()) {
                        cardErrors.textContent = "يرجى إدخال اسم حامل البطاقة";
                        cardErrors.style.display = 'block';
                        btnPay.classList.remove('loading');
                        btnPay.disabled = false;
                        return;
                    }

                    const { token, error } = await stripe.createToken(card, {
                        name: cardHolderName,
                        email: document.getElementById('email').value
                    });

                    if(error) {
                        cardErrors.textContent = error.message;
                        cardErrors.style.display = 'block';
                        btnPay.classList.remove('loading');
                        btnPay.disabled = false;
                    } else {
                        cardErrors.style.display = 'none';
                        // Injecter le token dans le formulaire et soumettre
                        document.getElementById('stripeToken').value = token.id;
                        paymentForm.submit();
                    }
                }
                // Sinon méthode différente, soumission normale
            });
        });
    </script>
</body>
</html>