<?php

use App\Actions\Chatbot\ExchangeCurrencyChatbotAction;
use App\Actions\Chatbot\LoginUserChatbotAction;
use App\Actions\Chatbot\ValidateCurrencyCodeChatbotAction;

return [

    /*
    |--------------------------------------------------------------------------
    | Chatbot Message Commands
    |--------------------------------------------------------------------------
    |
    | Here you may specify which commands can be process by the chatbot
    |
    */

    'actions' => [
        '@exchange' => [
            ValidateCurrencyCodeChatbotAction::class,
            ExchangeCurrencyChatbotAction::class,
        ],
        '@login' => [
            LoginUserChatbotAction::class
        ],
    ],
];
