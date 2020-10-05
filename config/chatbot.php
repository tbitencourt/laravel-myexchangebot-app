<?php

use App\Actions\Chatbot\ExchangeCurrency;

return [

    /*
    |--------------------------------------------------------------------------
    | Chatbot Message Commands
    |--------------------------------------------------------------------------
    |
    | Here you may specify which commands can be process by the chatbot
    |
    */

    'commands' => [
        '@exchange' => ExchangeCurrency::class,
    ],
];
