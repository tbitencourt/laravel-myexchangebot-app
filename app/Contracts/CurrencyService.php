<?php

namespace App\Contracts;

/**
 * Interface CurrencyService
 * @package App\Contracts
 */
interface CurrencyService
{
    /**
     * @param string $currency
     * @return bool
     */
    public function checkCacheCurrency(string $currency): bool;

    /**
     * @param string $currency
     * @param bool $valid
     * @return $this
     */
    public function registerCheckedCurrency(string $currency, bool $valid): self;
}
