<?php

namespace App\Repositories;

use App\Contracts\ChatbotActionRepository as ChatbotActionRepositoryContract;
use App\Models\ChatbotAction;

/**
 * Class ChatbotActionRepository
 * @package App\Repositories
 */
class ChatbotActionRepository implements ChatbotActionRepositoryContract
{
    /**
     * @var ChatbotAction
     */
    private ChatbotAction $model;

    /**
     * ChatbotHintRepository constructor.
     * @param ChatbotAction $model
     */
    public function __construct(ChatbotAction $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritDoc
     */
    public function startAction(array $data): string
    {
        /** @var ChatbotAction $action */
        $action = $this->model
            ->newQuery()
            ->create([
                'action_enum' => $data['action_enum'],
                'content' => $this->getEncodedContent($data['content'] ?? []),
                'status_enum' => ChatbotAction::KEY_STATUS_PENDING,
                'start_date' => now(),
            ]);
        $action->generateHash();
        return $action->hash;
    }

    /**
     * @inheritDoc
     */
    public function endAction(string $hash): array
    {
        /** @var ChatbotAction $action */
        $action = $this->model
            ->newQuery()
            ->where('hash', $hash)
            ->firstOrFail();
        $action->endAction();
        return $this->getDecodedContent($action->content);
    }

    /**
     * @param mixed $content
     * @return false|string
     */
    protected function getEncodedContent($content)
    {
        return json_encode((array)$content, true);
    }

    /**
     * @param string $content
     * @return array
     */
    protected function getDecodedContent(string $content): array
    {
        return (array)json_decode($content);
    }

}
