<?php

return [
    'features' => [
        'auth'         => env('FEATURE_AUTH', true),
        'user'         => env('FEATURE_USER', true),
        'tenant'       => env('FEATURE_TENANT', true),
        'panel'        => env('FEATURE_PANEL', true),
        'request'      => env('FEATURE_REQUEST', true),
        'setting'      => env('FEATURE_SETTING', true),
        'quotation'    => env('FEATURE_QUOTATION', true),
        'notification' => env('FEATURE_NOTIFICATION', true),
        'email'        => env('FEATURE_EMAIL', true),
        'dashboard'    => env('FEATURE_DASHBOARD', true),
    ],
];