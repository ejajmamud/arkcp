<?php

return [
    'whitelisted_ips' => [
        '13.228.26.102', // HitPay production IP
        '13.228.26.105', // HitPay sandbox IP
        '127.0.0.1'      // For local testing
    ],
    'sandbox' => env('HITPAY_SANDBOX', true),
    'api_key' => env('HITPAY_API_KEY'),
    'salt' => env('HITPAY_SALT')
];