<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>نيورال بوكس | تأكيد الاشتراك</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }

        .confirmation-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
        }

        .success-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(45deg, #28a745, #20c997);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            animation: pulse 2s infinite;
        }

        .success-icon i {
            color: white;
            font-size: 40px;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .payment-details {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin: 30px 0;
            text-align: right;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .detail-row:last-child {
            border-bottom: none;
            font-weight: bold;
            font-size: 18px;
        }

        .btn-dashboard {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 25px;
            text-decoration: none;
            display: inline-block;
            margin: 10px;
            transition: transform 0.3s;
        }

        .btn-dashboard:hover {
            transform: translateY(-2px);
            color: white;
            text-decoration: none;
        }

        .next-steps {
            background: #e8f4f8;
            border-radius: 10px;
            padding: 20px;
            margin-top: 30px;
            text-align: right;
        }
    </style>
</head>

<body>
    @if(session('success'))
    <div style="background-color: #d4edda; padding: 10px; text-align: center; color: #155724;">
        {{ session('success') }}
    </div>
    @endif

    @if(session('info'))
    <div style="background-color: #d1ecf1; padding: 10px; text-align: center; color: #0c5460;">
        {{ session('info') }}
    </div>
    @endif

    <div class="confirmation-container">
        <div class="success-card">
            <div class="success-icon">
                <i class="fas fa-check"></i>
            </div>

            <h2 class="text-success mb-3">مبروك! تم تأكيد اشتراكك</h2>
            <p class="lead">شكراً لك على اختيار نيورال بوكس. تم معالجة دفعتك بنجاح.</p>

            <div class="payment-details">
                <h5 class="mb-3">تفاصيل الدفعة</h5>

                <div class="detail-row">
                    <span>رقم المعاملة:</span>
                    <span><strong>#{{ $paymentInfo->id }}</strong></span>
                </div>

                <div class="detail-row">
                    <span>اسم حامل البطاقة:</span>
                    <span>{{ $paymentInfo->name }}</span>
                </div>

                @if($paymentInfo->method === 'stripe')
                <div class="detail-row">
                    <span>رقم البطاقة:</span>
                    <span>{{ $paymentInfo->masked_card_number ?? '**** **** **** ****' }}</span>
                </div>
                @endif



                <div class="detail-row">
                    <span>طريقة الدفع:</span>
                    <span>
                        @switch($paymentInfo->method)
                        @case('stripe') بطاقة ائتمان @break
                        @case('paypal') PayPal @break
                        @case('bank_transfer') تحويل بنكي @break
                        @default {{ $paymentInfo->payment_method }}
                        @endswitch
                    </span>
                </div>

                <div class="detail-row">
                    <span>البريد الإلكتروني:</span>
                    <span>{{ $paymentInfo->email ?? 'غير متوفر' }}</span>
                </div>


                <div class="detail-row">
                    <span>تاريخ الدفع:</span>
                    <span>{{ $paymentInfo->created_at->format('d/m/Y H:i') }}</span>
                </div>

                <div class="detail-row">
                    <span>المبلغ المدفوع:</span>
                    <span class="text-success"><strong>{{ number_format($paymentInfo->amount, 2) }} درهم</strong></span>
                </div>
            </div>

            <div class="action-buttons">
                <a href="{{ route('dashboard') }}" class="btn-dashboard">
                    <i class="fas fa-tachometer-alt"></i> الذهاب للوحة التحكم
                </a>

                <a href="{{ route('subscriptions.index') }}" class="btn-dashboard" style="background: linear-gradient(45deg, #28a745, #20c997);">
                    <i class="fas fa-arrow-right"></i> العودة للاشتراكات
                </a>
            </div>

            <div class="next-steps">
                <h5><i class="fas fa-lightbulb"></i> الخطوات التالية</h5>
                <ul class="text-right" style="list-style: none; padding: 0;">
                    <li><i class="fas fa-check text-success"></i> ستتلقى رسالة تأكيد على بريدك الإلكتروني</li>
                    <li><i class="fas fa-check text-success"></i> يمكنك الآن الوصول لجميع محتويات الباقة</li>
                    <li><i class="fas fa-check text-success"></i> ابدأ رحلة التعلم مع طفلك اليوم</li>
                    <li><i class="fas fa-check text-success"></i> تواصل معنا إذا كنت تحتاج أي مساعدة</li>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>