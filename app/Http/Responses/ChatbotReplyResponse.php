<?php

namespace App\Http\Responses;

use App\Contracts\ChatbotReplyResource as ChatbotReplyResourceContract;
use App\Contracts\ChatbotReplyResponse as ChatbotReplyResponseContract;
use App\Exceptions\ContentTypeException;

/**
 * Class ChatbotReplyResponse
 * @package App\Http\Responses
 */
class ChatbotReplyResponse implements ChatbotReplyResponseContract
{
    /**
     * @var ChatbotReplyResourceContract
     */
    protected ChatbotReplyResourceContract $resource;

    /**
     * @inheritDoc
     */
    public function toResponse($request)
    {
        if ($request->expectsJson()) {
            return $this->resource->toResponse($request);
        }
        /** @noinspection PhpUnhandledExceptionInspection */
        throw new ContentTypeException();
    }

    /**
     * @inheritDoc
     */
    public function setResource($resource): self
    {
        $this->resource = $resource;
        return $this;
    }
}
