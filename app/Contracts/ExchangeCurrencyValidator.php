<?php

namespace App\Contracts;

use App\Contracts\ChatbotMessageTransfer as ChatbotMessageTransferContract;

/**
 * Class ExchangeCurrencyValidator
 * @package App\Validators
 */
interface ExchangeCurrencyValidator
{
    const KEY_EXCHANGE_ACTION = "@exchange";

    /**
     * @param ChatbotMessageTransferContract $transfer
     * @return bool
     */
    public function isValid(ChatbotMessageTransferContract $transfer): bool;
}
