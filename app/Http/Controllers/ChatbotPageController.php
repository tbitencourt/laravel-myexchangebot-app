<?php

namespace App\Http\Controllers;

use App\Models\ChatbotMessage;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * Class ChatbotPageController
 * @package App\Http\Controllers
 */
class ChatbotPageController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $chatbotMessages = ChatbotMessage::all();
        return view('chatbot', compact('chatbotMessages'));
    }
}
