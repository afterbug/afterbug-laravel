<?php

return [
    /*
    |--------------------------------------------------------------------------
    | API Key
    |--------------------------------------------------------------------------
    |
    | You can find your API key on your AfterBug project dashboard.
    |
    | This api key points AfterBug to the project in your account
    | which should receive your application's exceptions.
    |
    */

    'api_key' => env('AFTERBUG_API_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | Blacklist
    |--------------------------------------------------------------------------
    |
    | Use this if you want to ensure you don't send sensitive data such as
    | password, credit card numbers to our servers. Any keys in input request
    | which contain these strings will be filtered.
    |
    */

    'blacklist' => ['password'],

    /*
    |--------------------------------------------------------------------------
    | User Attributes
    |--------------------------------------------------------------------------
    |
    | Use this if you want to filter user attributes that will be send
    | to our servers.
    |
    */

    'user_attributes' => ['id', 'name', 'username', 'email'],
];
