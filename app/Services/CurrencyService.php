<?php


namespace App\Services;

use App\Contracts\CurrencyService as CurrencyServiceContract;
use Illuminate\Cache\Repository as Cache;

/**
 * Class CurrencyService
 * @package App\Services
 */
class CurrencyService implements CurrencyServiceContract
{
    const KEY_CHECKED_CURRENCIES = "checked_currencies";
    /**
     * @var Cache
     */
    private Cache $cache;

    /**
     * CurrencyService constructor.
     * @param Cache $cache
     */
    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @inheritDoc
     */
    public function checkCacheCurrency(string $currency): bool
    {
        $currencies = $this->getCurrencies();
        return isset($currencies[$currency]);
    }

    /**
     * @inheritDoc
     */
    public function registerCheckedCurrency(string $currency, bool $valid): self
    {
        $currencies = $this->getCurrencies();
        $currencies[$currency] = $valid;
        $this->cache->forever(static::KEY_CHECKED_CURRENCIES, $currencies);
        return $this;
    }

    /**
     * @return array
     */
    protected function getCurrencies(): array
    {
        return $this->cache->rememberForever(
            static::KEY_CHECKED_CURRENCIES
            , function () {
            return [];
        });
    }

}
