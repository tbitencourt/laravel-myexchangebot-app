<?php

namespace App\Contracts;

use App\Actions\Chatbot\AbstractChatbotCommand as ChatbotCommand;
use App\Models\ChatbotHint;

/**
 * Class ChatbotService
 * @package App\Service
 */
interface ChatbotService
{
    /**
     * @param ChatbotMessageTransfer $transfer
     * @return null|ChatbotCommand
     */
    public function extractCommand(ChatbotMessageTransfer $transfer);

    /**
     * @return string[]
     */
    public function getMessageCommands(): array;

    /**
     * @param ChatbotMessageTransfer $transfer
     * @return ChatbotHint
     */
    public function replyMessage(ChatbotMessageTransfer $transfer);
}
