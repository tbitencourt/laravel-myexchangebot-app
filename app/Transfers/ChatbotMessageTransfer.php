<?php

namespace App\Transfers;

use App\Contracts\ChatbotMessageTransfer as ChatbotMessageTransferContract;

/**
 * Class ChatbotMessageTransfer
 * @package App\Transfers
 */
class ChatbotMessageTransfer extends AbstractTransfer implements ChatbotMessageTransferContract
{
    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->getData(static::KEY_MESSAGE);
    }

    /**
     * @param string $message
     * @return ChatbotMessageTransferContract
     */
    public function setMessage(string $message): ChatbotMessageTransferContract
    {
        return $this->setData(static::KEY_MESSAGE, $message);
    }
}
