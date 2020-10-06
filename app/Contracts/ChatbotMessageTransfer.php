<?php

namespace App\Contracts;

/**
 * Class ChatbotMessageTransfer
 * @package App\Transfers
 */
interface ChatbotMessageTransfer
{
    const KEY_ACTION = "action";
    const KEY_HASH = "hash";
    const KEY_MESSAGE = "message";

    /**
     * @return string
     */
    public function getAction(): string;

    /**
     * @param string $action
     * @return $this
     */
    public function setAction(string $action): self;

    /**
     * @return string
     */
    public function getHash(): string;

    /**
     * @param string $hash
     * @return $this
     */
    public function setHash(string $hash): self;

    /**
     * @return string
     */
    public function getMessage(): string;

    /**
     * @param string $message
     * @return $this
     */
    public function setMessage(string $message): self;
}
