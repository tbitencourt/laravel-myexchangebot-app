<?php


namespace App\Services;

use App\Contracts\ChatbotHintRepository as ChatbotHintRepositoryContract;
use App\Contracts\ChatbotMessageTransfer as ChatbotMessageTransferContract;
use App\Contracts\ChatbotService as ChatbotServiceContract;
use Illuminate\Support\Collection;
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
     * @inheritDoc
     */
    public function extractActions(ChatbotMessageTransferContract $transfer): Collection
    {
        $action = $transfer->getAction();
        $message = $transfer->getMessage();
        if ((!empty($action) && Str::startsWith($action, '@'))
            || Str::startsWith($message, '@')) {
            foreach ($this->getChatbotActionsConfig() as $key => $actionClass) {
                if ($key === $action) {
                    return collect((array)$actionClass);
                }
                if (Str::startsWith($message, $key)) {
                    return collect((array)$actionClass);
                }
            }
        }
        return collect();
    }

    /**
     * @inheritDoc
     */
    public function getChatbotActionsConfig(): array
    {
        return config('chatbot.actions');
    }

    /**
     * @inheritDoc
     */
    public function replyMessage(ChatbotMessageTransferContract $transfer)
    {
        return $this->repository->replayMessage($transfer->getMessage());
    }

}
