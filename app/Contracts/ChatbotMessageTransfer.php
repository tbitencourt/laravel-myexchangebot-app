<?php

namespace App\Contracts;

/**
 * Class ChatbotMessageTransfer
 * @package App\Transfers
 */
interface ChatbotMessageTransfer
{
    const KEY_MESSAGE = "message";
    const KEY_COMMANDS = "commands";

    /**
     * @return string
     */
    public function getMessage(): string;

    /**
     * @param string $message
     * @return $this
     */
    public function setMessage(string $message): self;
}
