<?php


namespace App\Contracts;

use Illuminate\Contracts\Support\Responsable;

/**
 * Interface ChatbotReplyResponse
 * @package App\Contracts
 */
interface ChatbotReplyResponse extends Responsable
{
    /**
     * @param ChatbotReplyResource $resource
     * @return $this
     * @noinspection PhpMissingParamTypeInspection
     */
    public function setResource($resource): self;
}
