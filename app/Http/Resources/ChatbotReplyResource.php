<?php

namespace App\Http\Resources;

use App\Contracts\ChatbotReplyResource as ChatbotReplyResourceContract;
use App\Models\ChatbotHint;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

/**
 * Class ChatbotReplyResource
 * @package App\Http\Resources
 */
class ChatbotReplyResource extends JsonResource implements ChatbotReplyResourceContract
{
    /**
     * @inheritDoc
     */
    public function toArray($request)
    {
        /** @var Collection $result */
        $result = $this->resource;
        /** @var Collection $actions */
        $actions = $result->get('actions');
        if ($actions->isEmpty()) {
            /** @var ChatbotHint $chatbotHint */
            $chatbotHint = $result->get('response');
            return [
                'reply' => $chatbotHint->reply,
            ];
        }
        /** @var Collection $actionsResponse */
        $actionsResponse = $result->get('response');
        /** @var Collection $response */
        $response = $actionsResponse->get($actionsResponse->keys()->last());
        return [
            'login' => $response->get('login'),
            'actions' => $response->get('actions'),
            'success' => $response->get('success', false),
            'reply' => $response->get('message', ''),
        ];
    }
}
