<?php


namespace App\Services;

use App\Actions\Chatbot\AbstractChatbotCommand as ChatbotCommand;
use App\Contracts\ChatbotHintRepository as ChatbotHintRepositoryContract;
use App\Contracts\ChatbotMessageTransfer as ChatbotMessageTransferContract;
use App\Contracts\ChatbotService as ChatbotServiceContract;
use App\Models\ChatbotHint;
use Illuminate\Support\Str;

/**
 * Class ChatbotService
 * @package App\Service
 */
class ChatbotService implements ChatbotServiceContract
{
    /**
     * @var ChatbotHintRepositoryContract
     */
    private ChatbotHintRepositoryContract $repository;

    /**
     * ChatbotService constructor.
     * @param ChatbotHintRepositoryContract $repository
     */
    public function __construct(ChatbotHintRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param ChatbotMessageTransferContract $transfer
     * @return null|ChatbotCommand
     */
    public function extractCommand(ChatbotMessageTransferContract $transfer)
    {
        $message = $transfer->getMessage();
        foreach ($this->getMessageCommands() as $key => $command) {
            if (Str::startsWith($message, $key)) {
                return app($command);
            }
        }
        return null;
    }

    /**
     * @return string[]
     */
    public function getMessageCommands(): array
    {
        return config('chatbot.commands');
    }

    /**
     * @param ChatbotMessageTransferContract $transfer
     * @return ChatbotHint
     */
    public function replyMessage(ChatbotMessageTransferContract $transfer)
    {
        return $this->repository->replayMessage($transfer->getMessage());
    }
}
