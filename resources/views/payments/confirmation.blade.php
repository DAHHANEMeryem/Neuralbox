<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>نيورال بوكس | تأكيد الاشتراك</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Tajawal', sans-serif;
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
            background: linear-gradient(#775b9f);
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
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
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

    <div class="confirmation-container">
        <div class="success-card">
          <div class="success-icon"> <i class="fas fa-check"></i> </div>

            <h2 class="text-success mb-3"> تم تسجيل طلبكم!</h2>
            <p class="lead"> شكراً لاختياركم نيورال بوكس. سيقوم فريقنا بالتواصل معكم قريبًا لتأكيد اشتراككم.</p>

            <div class="payment-details">
                <h5 class="mb-3">تفاصيل الدفعة</h5>

                @php
                    $packs = [
                        'golden' => 'Golden',
                        'silver' => 'NeuralBox',
                    ];
                @endphp

                <div class="detail-row">
                    <span>رقم المعاملة:</span>
                    <span><strong>#{{ $paymentInfo->id }}</strong></span>
                </div>

                <div class="detail-row">
                    <span>الباقة:</span>
                    <span>{{ $packs[$paymentInfo->pack] ?? 'غير متوفر' }}</span>
                </div>

                <div class="detail-row">
                    <span>اسم حامل البطاقة:</span>
                    <span>{{ $paymentInfo->name ?? 'غير متوفر' }}</span>
                </div>

                <div class="detail-row">
                    <span>البريد الإلكتروني:</span>
                    <span>{{ $paymentInfo->email ?? 'غير متوفر' }}</span>
                </div>

                <div class="detail-row">
                    <span>الهاتف:</span>
                    <span>{{ $paymentInfo->phone ?? 'غير متوفر' }}</span>
                </div>

                <div class="detail-row">
                    <span>المدينة:</span>
                    <span>{{ $paymentInfo->city ?? 'غير متوفر' }}</span>
                </div>

                <div class="detail-row">
                    <span>العنوان:</span>
                    <span>{{ $paymentInfo->address ?? 'غير متوفر' }}</span>
                </div>

                <div class="detail-row">
                    <span>المبلغ المدفوع:</span>
                    <span class="text-success"><strong>{{ number_format($paymentInfo->amount, 2) }} درهم</strong></span>
                </div>
            </div>

            <div class="action-buttons">
                <a href="{{ route('home') }}" class="btn-dashboard" style="background: linear-gradient(#775b9f);">
                    <i class="fas fa-arrow-right"></i> NeuralBox
                </a>
            </div>

        </div>
    </div>
</body>

</html>
