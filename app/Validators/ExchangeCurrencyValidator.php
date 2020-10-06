<?php


namespace App\Validators;

use App\Contracts\ChatbotMessageTransfer as ChatbotMessageTransferContract;
use App\Contracts\ExchangeCurrencyValidator as ExchangeCurrencyValidatorContract;
use Illuminate\Support\Str;

/**
 * Class ExchangeCurrencyValidator
 * @package App\Validators
 */
class ExchangeCurrencyValidator implements ExchangeCurrencyValidatorContract
{
    /**
     * @param ChatbotMessageTransferContract $transfer
     * @return bool
     */
    public function isValid(ChatbotMessageTransferContract $transfer): bool
    {
        $parameters = explode(" ", $transfer->getMessage());
        if (count($parameters) !== 4) {
            return false;
        }
        if ($parameters[0] !== static::KEY_EXCHANGE_ACTION) {
            return false;
        }
        if (!is_string($parameters[1]) || Str::length($parameters[1]) !== 3
            || !is_string($parameters[2]) || Str::length($parameters[2]) !== 3) {
            return false;
        }
        if (!is_numeric($parameters['3'])) {
            return false;
        }
        return true;
    }
}
