<?php

namespace App\Providers;

use App\Actions\ProcessChatbotMessage;
use App\Builders\ChatbotMessageTransferBuilder;
use App\Contracts\ChatbotActionRepository as ChatbotActionRepositoryContract;
use App\Contracts\ChatbotHintRepository as ChatbotHintRepositoryContract;
use App\Contracts\ChatbotMessageTransfer as ChatbotMessageTransferContract;
use App\Contracts\ChatbotMessageTransferBuilder as ChatbotMessageTransferBuilderContract;
use App\Contracts\ChatbotReplyResource as ChatbotReplyResourceContract;
use App\Contracts\ChatbotReplyResponse as ChatbotReplyResponseContract;
use App\Contracts\ChatbotService as ChatbotServiceContract;
use App\Contracts\CurrencyService as CurrencyServiceContract;
use App\Contracts\ExchangeCurrencyValidator as ExchangeCurrencyValidatorContract;
use App\Contracts\LoginService as LoginServiceContract;
use App\Contracts\LoginUserValidator as LoginUserValidatorContract;
use App\Contracts\ProcessChatbotMessage as ProcessChatbotMessageContract;
use App\Http\Resources\ChatbotReplyResource;
use App\Http\Responses\ChatbotReplyResponse;
use App\Repositories\ChatbotActionRepository;
use App\Repositories\ChatbotHintRepository;
use App\Services\ChatbotService;
use App\Services\CurrencyService;
use App\Services\LoginService;
use App\Transfers\ChatbotMessageTransfer;
use App\Validators\ExchangeCurrencyValidator;
use App\Validators\LoginUserValidator;
use Illuminate\Support\ServiceProvider;

/**
 * Class ChatbotServiceProvider
 * @package App\Providers
 */
class ChatbotServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //Binding all contracts
        $this->app->bind(ChatbotActionRepositoryContract::class, ChatbotActionRepository::class);
        $this->app->bind(ChatbotHintRepositoryContract::class, ChatbotHintRepository::class);
        $this->app->bind(ChatbotMessageTransferContract::class, ChatbotMessageTransfer::class);
        $this->app->bind(ChatbotMessageTransferBuilderContract::class, ChatbotMessageTransferBuilder::class);
        $this->app->bind(ChatbotReplyResourceContract::class, ChatbotReplyResource::class);
        $this->app->bind(ChatbotReplyResponseContract::class, ChatbotReplyResponse::class);
        $this->app->bind(ChatbotServiceContract::class, ChatbotService::class);
        $this->app->bind(CurrencyServiceContract::class, CurrencyService::class);
        $this->app->bind(ExchangeCurrencyValidatorContract::class, ExchangeCurrencyValidator::class);
        $this->app->bind(LoginServiceContract::class, LoginService::class);
        $this->app->bind(LoginUserValidatorContract::class, LoginUserValidator::class);
        $this->app->bind(ProcessChatbotMessageContract::class, ProcessChatbotMessage::class);
    }
}
