<?php

namespace App\Http\Resources;

use App\Models\ChatbotMessage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

/**
 * Class ChatbotMessageResource
 * @package App\Http\Resources
 */
class ChatbotMessageResource extends JsonResource
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
        /** @var ChatbotMessage $chatbotMessage */
        $chatbotMessage = $this->resource;
        return [
            'message' => $chatbotMessage->message,
            'added_on' => Carbon::parse($chatbotMessage->added_on)->format('h:i A'),
            'type' => $chatbotMessage->type,
        ];
    }
}
