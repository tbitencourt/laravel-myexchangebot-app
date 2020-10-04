<?php

namespace App\Http\Resources;

use App\Models\ChatbotHint;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ChatbotReplyResource
 * @package App\Http\Resources
 */
class ChatbotReplyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     * @noinspection PhpMissingParamTypeInspection
     */
    public function toArray($request)
    {
        /** @var ChatbotHint $chatbotHint */
        $chatbotHint = $this->resource;
        return [
            'reply' => $chatbotHint->reply,
        ];
    }
}
