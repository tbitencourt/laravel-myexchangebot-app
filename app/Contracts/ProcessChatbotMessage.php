<?php

namespace App\Contracts;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

/**
 * Class ProcessMessage
 * @package App\Actions\Chatbot
 */
interface ProcessChatbotMessage
{
    /**
     * @param Request $request
     * @return Responsable
     * @throws Exception
     */
    public function process(Request $request): Responsable;
}
