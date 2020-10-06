<?php

namespace App\Repositories;

use App\Contracts\ChatbotHintRepository as ChatbotHintRepositoryContract;
use App\Models\ChatbotHint;

/**
 * Class ChatbotHintRepository
 * @package App\Repositories
 */
class ChatbotHintRepository implements ChatbotHintRepositoryContract
{
    /**
     * @var ChatbotHint
     */
    private ChatbotHint $model;

    /**
     * ChatbotHintRepository constructor.
     * @param ChatbotHint $model
     */
    public function __construct(ChatbotHint $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $message
     * @return ChatbotHint
     */
    public function replayMessage(string $message): ChatbotHint
    {
        /** @var ChatbotHint $hint */
        $hint = $this->model->newQuery()
            ->firstOrNew(
                [['question', 'like', "%$message%"]],
                ['reply' => __(static::DEFAULT_HINT_REPLY)]
            );
        return $hint;
    }
}
