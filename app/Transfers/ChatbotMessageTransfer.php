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
     * @inheritDoc
     */
    public function getAction(): string
    {
        return $this->getData(static::KEY_ACTION);
    }

    /**
     * @inheritDoc
     */
    public function setAction(string $action): ChatbotMessageTransferContract
    {
        return $this->setData(static::KEY_ACTION, $action);
    }

    /**
     * @inheritDoc
     */
    public function getHash(): string
    {
        return $this->getData(static::KEY_HASH);
    }

    /**
     * @inheritDoc
     */
    public function setHash(string $hash): ChatbotMessageTransferContract
    {
        return $this->setData(static::KEY_HASH, $hash);
    }

    /**
     * @inheritDoc
     */
    public function getMessage(): string
    {
        return $this->getData(static::KEY_MESSAGE);
    }

    /**
     * @inheritDoc
     */
    public function setMessage(string $message): ChatbotMessageTransferContract
    {
        return $this->setData(static::KEY_MESSAGE, $message);
    }
}
