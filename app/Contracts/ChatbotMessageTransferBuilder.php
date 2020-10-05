<?php

namespace App\Contracts;


use App\Contracts\ChatbotMessageTransfer as ChatbotMessageTransferContract;
use Illuminate\Http\Request;

/**
 * Class ChatbotMessageTransferBuilder
 * @package App\Builders
 */
interface ChatbotMessageTransferBuilder
{
    /**
     * @param Request $request
     * @return ChatbotMessageTransferContract
     */
    public function build(Request $request): ChatbotMessageTransferContract;

    /**
     * @return ChatbotMessageTransferContract
     */
    public function getTransfer(): ChatbotMessageTransferContract;

    /**
     * @param ChatbotMessageTransferContract $transfer
     */
    public function setTransfer(ChatbotMessageTransferContract $transfer): void;
}
