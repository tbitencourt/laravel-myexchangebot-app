<?php


namespace App\Builders;

use App\Contracts\ChatbotMessageTransfer as ChatbotMessageTransferContract;
use App\Contracts\ChatbotMessageTransferBuilder as ChatbotMessageTransferBuilderContract;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Class ChatbotMessageTransferBuilder
 * @package App\Builders
 */
class ChatbotMessageTransferBuilder implements ChatbotMessageTransferBuilderContract
{
    /**
     * @var ChatbotMessageTransferContract
     */
    private ChatbotMessageTransferContract $transfer;

    /**
     * ChatbotMessageTransferBuilder constructor.
     * @param ChatbotMessageTransferContract $transfer
     */
    public function __construct(ChatbotMessageTransferContract $transfer)
    {
        $this->transfer = $transfer;
    }

    /**
     * @param Request $request
     * @return ChatbotMessageTransferContract
     */
    public function build(Request $request): ChatbotMessageTransferContract
    {
        return $this->getTransfer()
            ->setMessage(Str::lower($request->get('question')));
    }

    /**
     * @return ChatbotMessageTransferContract
     */
    public function getTransfer(): ChatbotMessageTransferContract
    {
        return $this->transfer;
    }

    /**
     * @param ChatbotMessageTransferContract $transfer
     */
    public function setTransfer(ChatbotMessageTransferContract $transfer): void
    {
        $this->transfer = $transfer;
    }
}
