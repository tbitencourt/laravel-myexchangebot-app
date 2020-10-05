<?php

namespace App\Actions\Chatbot;

use App\Contracts\ChatbotMessageTransfer as ChatbotMessageTransferContract;
use Exception;

/**
 * Class AbstractChatbotCommand
 * @package App\Actions\Chatbot
 */
abstract class AbstractChatbotCommand
{
    /**
     * @param ChatbotMessageTransferContract $transfer
     * @return mixed
     * @throws Exception
     */
    public function __invoke(ChatbotMessageTransferContract $transfer)
    {
        return $this->execute($transfer);
    }

    /**
     * @param ChatbotMessageTransferContract $transfer
     * @return mixed
     * @throws Exception
     */
    abstract protected function execute(ChatbotMessageTransferContract $transfer);
}
