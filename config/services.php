<?php

return [


    'google' => [
        'client_id' => '905487072632-glo59l1cju83lq9anicuulpm65d07qqi.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost:8000/auth/google/callback',
    ],

  'github' =>[
    'client_id' =>'a0644f0264a584091814',
    'client_secret' =>'a7b622579fb9db6680a01c0d91647af77fc7cdfa',
    'redirect' => 'http://localhost:8000/auth/github/callback',

  ],

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

];
