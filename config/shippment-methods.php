<?php

return [

    'enabled' => [
        'andreani',
    ],

    'andreani' => [
        'user' => env('ANDREANI_USER'),
        'pwd' => env('ANDREANI_PASSWORD'),
        'client' => env('ANDREANI_CODE_CLIENT'),
        'contract_sucursal' => env('ANDREANI_CONTACT_SUCURSAL'),
        'contract_envio' => env('ANDREANI_CONTRACT_SHIPPMENT')
    ]
];