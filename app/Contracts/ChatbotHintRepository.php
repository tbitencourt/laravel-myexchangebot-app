<?php

namespace App\Contracts;


use App\Models\ChatbotHint;

/**
 * Class ChatbotHintRepository
 * @package App\Repositories
 */
interface ChatbotHintRepository
{
    const DEFAULT_HINT_REPLY = "Sorry not be able to understand you";
    /**
     * @param string $message
     * @return ChatbotHint
     */
    public function replayMessage(string $message): ChatbotHint;
}
