<?php

return [

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    // Dans config/services.php
    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URI'),
        'scopes' => ['openid', 'profile', 'email'],
    ],



    'stripe' => [
        'secret' => env('STRIPE_SECRET'),
        'public' => env('STRIPE_PUBLIC'),
    ],



    // Existing configurations...



    // Add PayPal configuration
    'paypal' => [
        'business_email' => env('PAYPAL_BUSINESS_EMAIL', 'your-paypal-business@email.com'),
        'sandbox' => env('PAYPAL_SANDBOX', true),
        'client_id' => env('PAYPAL_CLIENT_ID'),
        'client_secret' => env('PAYPAL_CLIENT_SECRET'),
    ],

    // Add bank transfer configuration
    'bank_transfer' => [
        'enabled' => env('BANK_TRANSFER_ENABLED', true),
        'auto_approve' => env('BANK_TRANSFER_AUTO_APPROVE', false),
        'admin_email' => env('BANK_TRANSFER_ADMIN_EMAIL', 'admin@yoursite.com'),
    ],
];
