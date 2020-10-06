<?php

namespace App\Contracts;

/**
 * Interface LoginService
 * @package App\Contracts
 */
interface LoginService
{
    /**
     * @param string $username
     * @return string
     */
    public function startLogin(string $username): string;

    /**
     * @param string $hash
     * @return array
     */
    public function endLogin(string $hash): string;
}
