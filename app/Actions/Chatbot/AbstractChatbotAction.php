<?php

namespace App\Actions\Chatbot;

use App\Contracts\ChatbotMessageTransfer as ChatbotMessageTransferContract;
use Exception;
use Illuminate\Support\Collection;

/**
 * Class AbstractChatbotCommand
 * @package App\Actions\Chatbot
 */
abstract class AbstractChatbotAction
{
    /**
     * @param ChatbotMessageTransferContract $transfer
     * @return Collection
     * @throws Exception
     */
    abstract public function __invoke(ChatbotMessageTransferContract $transfer): Collection;
}
