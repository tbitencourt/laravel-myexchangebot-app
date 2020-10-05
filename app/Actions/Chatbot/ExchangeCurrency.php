<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace App\Actions\Chatbot;

use App\Contracts\ChatbotMessageTransfer as ChatbotMessageTransferContract;
use App\Contracts\CurrencyService as CurrencyServiceContract;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

/**
 * Class ExchangeCurrency
 * @package App\Actions\Chatbot
 */
class ExchangeCurrency extends AbstractChatbotCommand
{
    /**
     * @var CurrencyServiceContract
     */
    protected CurrencyServiceContract $service;

    /**
     * @inheritDoc
     */
    protected function execute(ChatbotMessageTransferContract $transfer)
    {
        if ($this->validateParameters($transfer)) {
            $parameters = $this->extractParameters($transfer);
            if ($this->validateCurrencyCode($parameters)) {
                return $this->exchangeCurrency($parameters);
            }
        }
        return "At least one of currency codes is invalid!";
    }

    /**
     * @param ChatbotMessageTransferContract $transfer
     * @return bool
     */
    protected function validateParameters(ChatbotMessageTransferContract $transfer): bool
    {
        //@exchange &lt;currency_code_from&gt; &lt;currency_code_to&gt; &lt;value&gt;
        $parameters = explode(" ", $transfer->getMessage());
        if (count($parameters) !== 4) {
            return false;
        }
        if ($parameters[0] !== "@exchange") {
            return false;
        }
        if (!is_string($parameters[1]) || Str::length($parameters[1]) !== 3
            || !is_string($parameters[2]) || Str::length($parameters[2]) !== 3) {
            return false;
        }
        if (!is_numeric($parameters['3'])) {
            return false;
        }
        return true;
    }

    /**
     * @param ChatbotMessageTransferContract $transfer
     * @return Collection
     */
    protected function extractParameters(ChatbotMessageTransferContract $transfer)
    {
        //@exchange &lt;currency_code_from&gt; &lt;currency_code_to&gt; &lt;value&gt;
        $parameters = explode(" ", $transfer->getMessage());
        $from = Str::upper($parameters[1]);
        $to = Str::upper($parameters[2]);
        $amount = (float)$parameters[3];
        return collect([
            "access_key" => "2574d39f372f43481b94d0ed30b01f75",
            "symbols" => implode(",", [$from, $to]),
            "format" => 1,
            "api_key" => 'f7s6P5UhyrjacW3RtwinWjEFLbz9SL',
            "from" => $from,
            "to" => $to,
            "amount" => $amount,
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
        $response = Http::get('http://data.fixer.io/api/latest', [
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
     * @param Collection $parameters
     * @return mixed
     */
    protected function exchangeCurrency(Collection $parameters)
    {
        $response = Http::get('https://www.amdoren.com/api/currency.php', [
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
}
