<?php

return [

    'enabled' => [
        'mercadopago',
        'bitcoin',
        'paypal'
    ],

    'use_sandbox' => env('SANDBOX_GATEWAYS', true),

    'mercadopago' => [
       // 'logo' => '/img/payment/mercadopago.png',
        'display' => 'MercadoPago',
        'client' => env('MP_PUBLIC_KEY'),
        'secret' => env('MP_ACCESS_TOKEN')
    ],
    'bitcoin' => [
        'display' => 'Bitcoin',
        'url' => env('BUDA_URL'),
        'market' => env('BUDA_MARKET'),
        'key' => env('BUDA_API_KEY'),
        'secret' => env('BUDA_SECRET')
    ],
    'paypal' => [
        'display' => 'paypal',
        'app' => env('PAYPAL_APP'),
        'account' => env('PAYPAL_SANDBOX_ACCOUNT'),
        'client_id' => env('PAYPAL_CLIENT_ID'),
        'secret' => env('PAYPAL_SECRET'),
        'settings' => [
            'mode' => 'sandbox', //dsp hacelo bien pajin
            'http.ConnectionTimeout' => 30,
            'log.LogEnabled' => true,
            'log.Filename' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'ERROR'
        ],
    ],

];