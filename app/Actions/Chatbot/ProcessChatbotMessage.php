<?php


namespace App\Actions\Chatbot;

use App\Contracts\ChatbotMessageTransfer;
use App\Contracts\ChatbotMessageTransferBuilder;
use App\Contracts\ChatbotService as ChatbotServiceContract;
use App\Contracts\ProcessChatbotMessage as ProcessChatbotMessageContract;
use App\Http\Resources\ChatbotReplyResource;
use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

/**
 * Class ProcessMessage
 * @package App\Actions\Chatbot
 */
class ProcessChatbotMessage implements ProcessChatbotMessageContract
{
    /**
     * @var ChatbotMessageTransferBuilder
     */
    private ChatbotMessageTransferBuilder $builder;
    /**
     * @var ChatbotServiceContract
     */
    private ChatbotServiceContract $service;

    /**
     * ProcessMessage constructor.
     * @param ChatbotMessageTransferBuilder $builder
     * @param ChatbotServiceContract $service
     */
    public function __construct(
        ChatbotMessageTransferBuilder $builder
        , ChatbotServiceContract $service)
    {
        $this->builder = $builder;
        $this->service = $service;
    }

    /**
     * @inheritDoc
     */
    public function process(Request $request): Responsable
    {
        $transfer = $this->builder->build($request);
        $result = $this->doProcess($transfer);
        return $this->prepareResponse($result);
    }

    /**
     * @param ChatbotMessageTransfer $transfer
     * @return Collection
     * @throws Exception
     */
    protected function doProcess(ChatbotMessageTransfer $transfer)
    {
        $result = new Collection();
        $command = $this->service->extractCommand($transfer);
        $result->put('command', $command);
        if (empty($command)) {
            $result->put('response', $this->service->replyMessage($transfer));
            return $result;
        }
        $result->put('response', $command($transfer));
        return $result;
    }

    /**
     * @param Collection $result
     * @return JsonResource
     */
    protected function prepareResponse(Collection $result): JsonResource
    {
        return (new ChatbotReplyResource($result));
    }
}
