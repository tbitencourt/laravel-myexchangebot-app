<?php

namespace App\Actions\Chatbot;

use App\Contracts\ChatbotMessageTransfer as ChatbotMessageTransferContract;
use App\Contracts\CurrencyService as CurrencyServiceContract;
use App\Contracts\ExchangeCurrencyValidator as ExchangeCurrencyValidatorContract;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

/**
 * Class ValidateCurrencyCode
 * @package App\Actions\Chatbot
 */
class ValidateCurrencyCodeChatbotAction extends AbstractChatbotAction
{
    const RESPONSE_MESSAGE_VALID = "All currency codes are valid!";
    const RESPONSE_MESSAGE_INVALID = "At least one of currency codes is invalid!";
    const DATA_FIXER_FORMAT = 1;
    const KEY_PARAMETER_FROM = 1;
    const KEY_PARAMETER_TO = 2;
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
            if ($this->validateCurrencyCode($parameters)) {
                return collect([
                    'success' => true,
                    'message' => __(self::RESPONSE_MESSAGE_VALID),
                ]);
            }
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
    protected function extractParameters(ChatbotMessageTransferContract $transfer)
    {
        $parameters = explode(" ", $transfer->getMessage());
        $from = Str::upper($parameters[self::KEY_PARAMETER_FROM]);
        $to = Str::upper($parameters[self::KEY_PARAMETER_TO]);
        return collect([
            "access_key" => env('DATAFIXER_KEY'),
            "symbols" => implode(",", [$from, $to]),
            "format" => self::DATA_FIXER_FORMAT,
        ]);
    }

    /**
     * @param Collection $parameters
     * @return bool
     */
    protected function validateCurrencyCode(Collection $parameters)
    {
        $valid = 0;
        $currencies = explode(",", $parameters->get("symbols"));
        foreach ($currencies as $currency) {
            if ($this->getService()->checkCacheCurrency($currency)) {
                $valid++;
            }
        }
        if ($valid === count($currencies)) {
            return true;
        }
        $response = Http::get(env('DATAFIXER_URL'), [
            "access_key" => $parameters->get("access_key"),
            "symbols" => $parameters->get("symbols"),
            "format" => $parameters->get("format"),
        ]);
        if ($response->failed() || $response['success'] == false) {
            return false;
        }
        $valid = 0;
        foreach ($currencies as $currency) {
            if (isset($response['rates'][$currency])) {
                $this->getService()->registerCheckedCurrency($currency, true);
                $valid++;
                continue;
            }
            $this->getService()->registerCheckedCurrency($currency, false);
        }
        return $valid === count($currencies);

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
