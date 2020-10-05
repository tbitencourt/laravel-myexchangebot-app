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
        if (empty($result->get('command'))) {
            /** @var ChatbotHint $chatbotHint */
            $chatbotHint = $result->get('response');
            return [
                'reply' => $chatbotHint->reply,
            ];
        }

        return [
            'reply' => $result->get('response'),
        ];
    }
}
