<?php

return [
    'api_url' => env('TAWASOL_SMS_API_URL', 'https://tawasolsms.com:8582/websmpp/websms'),
    'user' => env('TAWASOL_SMS_USER'),
    'pass' => env('TAWASOL_SMS_PASS'),
    'sid' => env('TAWASOL_SMS_SID'),
];
