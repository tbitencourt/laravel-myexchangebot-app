<?php

namespace App\Transfers;

/**
 * Class AbstractTransfer
 * @package App\Transfers
 */
abstract class AbstractTransfer
{
    /**
     * @var array
     */
    protected array $data = [];

    /**
     * AbstractTransfer constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * @param string|array $key
     * @param mixed $value
     * @return $this
     */
    public function setData($key, $value = null)
    {
        if (is_array($key)) {
            $this->data = $key;
        } else {
            $this->data[$key] = $value;
        }
        return $this;
    }

    /**
     * @param null|string|array $key
     * @return $this
     */
    public function unsetData($key = null)
    {
        if ($key === null) {
            $this->setData([]);
        } elseif (is_string($key)) {
            if (isset($this->data[$key]) || array_key_exists($key, $this->data)) {
                unset($this->data[$key]);
            }
        } elseif (is_array($key)) {
            foreach ($key as $element) {
                $this->unsetData($element);
            }
        }
        return $this;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getData(string $key = '')
    {
        if ('' === $key) {
            return $this->data;
        }
        if (isset($this->data[$key])) {
            return $this->data[$key];
        }
        return null;
    }
}
