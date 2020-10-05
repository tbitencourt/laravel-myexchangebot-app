<?php

namespace App\Http\Controllers;

use App\Contracts\ChatbotReplyResource as ChatbotReplyResourceContract;
use App\Contracts\ChatbotReplyResponse as ChatbotReplyResponseContract;
use App\Contracts\ProcessChatbotMessage as ProcessChatbotMessageContract;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ChatbotController
 * @package App\Http\Controllers
 */
class ChatbotController extends Controller
{
    /**
     * @param Request $request
     * @param ProcessChatbotMessageContract $process
     * @param ChatbotReplyResponseContract $response
     * @return Response
     * @throws Exception
     */
    public function processMessage(Request $request, ProcessChatbotMessageContract $process, ChatbotReplyResponseContract $response): Response
    {
        /** @var ChatbotReplyResourceContract $resource */
        $resource = $process->process($request);
        return $response->setResource($resource)->toResponse($request);
    }
}
