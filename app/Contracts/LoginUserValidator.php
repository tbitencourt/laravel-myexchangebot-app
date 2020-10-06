<?php

namespace App\Contracts;


use App\Contracts\ChatbotMessageTransfer as ChatbotMessageTransferContract;

/**
 * Class LoginUserValidator
 * @package App\Validators
 */
interface LoginUserValidator
{
    const KEY_LOGIN_ACTION = "@login";

    /**
     * @param ChatbotMessageTransferContract $transfer
     * @return bool
     */
    public function isValid(ChatbotMessageTransferContract $transfer): bool;
}
