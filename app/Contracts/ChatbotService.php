<?php

namespace App\Contracts;

use App\Models\ChatbotHint;
use Illuminate\Support\Collection;

/**
 * Class ChatbotService
 * @package App\Service
 */
interface ChatbotService
{
    /**
     * @param ChatbotMessageTransfer $transfer
     * @return Collection
     */
    public function extractActions(ChatbotMessageTransfer $transfer): Collection;

    /**
     * @return array
     */
    public function getChatbotActionsConfig(): array;

    /**
     * @param ChatbotMessageTransfer $transfer
     * @return ChatbotHint
     */
    public function replyMessage(ChatbotMessageTransfer $transfer);
}
