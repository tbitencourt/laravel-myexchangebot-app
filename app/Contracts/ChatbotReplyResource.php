<?php

namespace App\Contracts;


use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

/**
 * Class ChatbotReplyResource
 * @package App\Http\Resources
 */
interface ChatbotReplyResource extends Responsable
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     * @noinspection PhpMissingParamTypeInspection
     */
    public function toArray($request);
}
