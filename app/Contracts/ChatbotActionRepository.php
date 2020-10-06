<?php

namespace App\Contracts;

/**
 * Class ChatbotActionRepository
 * @package App\Repositories
 */
interface ChatbotActionRepository
{
    /**
     * @param array $data
     * @return string
     */
    public function startAction(array $data): string;

    /**
     * @param string $hash
     * @return array
     */
    public function endAction(string $hash): array;
}
