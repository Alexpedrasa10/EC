<?php

return [

    'enabled' => [
        'mercadopago',
    ],

    'use_sandbox' => env('SANDBOX_GATEWAYS', true),

    'mercadopago' => [
       // 'logo' => '/img/payment/mercadopago.png',
        'display' => 'MercadoPago',
        'client' => env('MP_PUBLIC_KEY'),
        'secret' => env('MP_ACCESS_TOKEN')
    ],

];