<?php

namespace App\Actions\Chatbot;

use App\Contracts\ChatbotMessageTransfer as ChatbotMessageTransferContract;
use App\Contracts\CurrencyService as CurrencyServiceContract;
use App\Contracts\ExchangeCurrencyValidator as ExchangeCurrencyValidatorContract;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

/**
 * Class ExchangeCurrency
 * @package App\Actions\Chatbot
 */
class ExchangeCurrencyChatbotAction extends AbstractChatbotAction
{
    const RESPONSE_MESSAGE_INVALID = "At least one of currency codes is invalid!";
    const KEY_PARAMETER_FROM = 1;
    const KEY_PARAMETER_TO = 2;
    const KEY_PARAMETER_AMOUNT = 3;
    /**
     * @var CurrencyServiceContract
     */
    protected CurrencyServiceContract $service;
    /**
     * @var ExchangeCurrencyValidatorContract
     */
    protected ExchangeCurrencyValidatorContract $validator;

    /**
     * @inheritDoc
     */
    public function __invoke(ChatbotMessageTransferContract $transfer): Collection
    {
        if ($this->getValidator()->isValid($transfer)) {
            $parameters = $this->extractParameters($transfer);
            return collect([
                'success' => true,
                'message' => $this->exchangeCurrency($parameters),
            ]);
        }
        return collect([
            'success' => false,
            'message' => __(self::RESPONSE_MESSAGE_INVALID)
        ]);
    }

    /**
     * @param ChatbotMessageTransferContract $transfer
     * @return Collection
     */
    protected function extractParameters(ChatbotMessageTransferContract $transfer): Collection
    {
        $parameters = explode(" ", $transfer->getMessage());
        $from = Str::upper($parameters[self::KEY_PARAMETER_FROM]);
        $to = Str::upper($parameters[self::KEY_PARAMETER_TO]);
        $amount = (float)$parameters[self::KEY_PARAMETER_AMOUNT];
        return collect([
            "api_key" => env('AMDOREN_KEY'),
            "from" => $from,
            "to" => $to,
            "amount" => $amount,
        ]);
    }

    /**
     * @param Collection $parameters
     * @return mixed
     */
    protected function exchangeCurrency(Collection $parameters)
    {
        $response = Http::get(env('AMDOREN_URL'), [
            "api_key" => $parameters->get("api_key"),
            "from" => $parameters->get("from"),
            "to" => $parameters->get("to"),
            "amount" => $parameters->get("amount"),
        ]);

        return $response['amount'];
    }

    /**
     * @return CurrencyServiceContract
     */
    public function getService(): CurrencyServiceContract
    {
        $this->service ??= app(CurrencyServiceContract::class);
        return $this->service;
    }

    /**
     * @return ExchangeCurrencyValidatorContract
     */
    public function getValidator(): ExchangeCurrencyValidatorContract
    {
        $this->validator ??= app(ExchangeCurrencyValidatorContract::class);
        return $this->validator;
    }
}
