<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChatbotMessageResource;
use App\Http\Resources\ChatbotReplyResource;
use App\Models\ChatbotHint;
use App\Models\ChatbotMessage;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Tightenco\Collect\Support\Collection;

/**
 * Class ChatbotController
 * @package App\Http\Controllers
 */
class ChatbotController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $chatbotMessages = ChatbotMessage::all();
        return view('chatbot', compact('chatbotMessages'));
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function showHistory(): ResourceCollection
    {
//        $chatbotMessages = Collect([]);
//        if (auth()->check()) {
        $chatbotMessages = ChatbotMessage::all();
//        }
        return ChatbotMessageResource::collection($chatbotMessages);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection|\Illuminate\Support\Collection|string|Collection
     */
    public function processMessage(Request $request)
    {
        $question = $request->get('question', '');
        /** @var ChatbotHint $hint */
        $hint = ChatbotHint::query()
            ->firstOrNew(
                [['question', 'like', "%$question%"]],
                ['reply' => "Sorry not be able to understand you"]
            );

        return new ChatbotReplyResource($hint);
    }
}
