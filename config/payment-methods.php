<?php

return [

    'enabled' => [
        'mercadopago',
        'bitcoin'
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

];