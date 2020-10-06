<?php

namespace App\Validators;

use App\Contracts\ChatbotMessageTransfer as ChatbotMessageTransferContract;
use App\Contracts\LoginUserValidator as LoginUserValidatorContract;
use Illuminate\Support\Str;

/**
 * Class LoginUserValidator
 * @package App\Validators
 */
class LoginUserValidator implements LoginUserValidatorContract
{
    /**
     * @param ChatbotMessageTransferContract $transfer
     * @return bool
     */
    public function isValid(ChatbotMessageTransferContract $transfer): bool
    {
        return empty($transfer->getAction())
            ? $this->isUsernameValid($transfer)
            : $this->isPasswordValid($transfer);
    }

    /**
     * @param ChatbotMessageTransferContract $transfer
     * @return bool
     */
    protected function isUsernameValid(ChatbotMessageTransferContract $transfer): bool
    {
        $parameters = explode(" ", $transfer->getMessage());
        if (count($parameters) !== 2) {
            return false;
        }
        if (static::KEY_LOGIN_ACTION !== $parameters[0]) {
            return false;
        }
        $username = $parameters[1];
        if (!is_string($username) || is_numeric($username[0]) || Str::length($parameters[1]) <= 6) {
            return false;
        }
        return true;
    }

    /**
     * @param ChatbotMessageTransferContract $transfer
     * @return bool
     */
    protected function isPasswordValid(ChatbotMessageTransferContract $transfer): bool
    {
        if (static::KEY_LOGIN_ACTION !== $transfer->getAction()) {
            return false;
        }
        if (empty($transfer->getHash())) {
            return false;
        }
        if (empty($transfer->getMessage())) {
            return false;
        }
        return true;
    }
}
