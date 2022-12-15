<?php

return [
    'api_key' => env('SHIPPER_API_KEY', ''),

    'sandbox' => env('SHIPPER_SANDBOX', false),

    'database' => [
        'connection' => '',

        'table_prefix' => 'shipper_',
    ],
];
