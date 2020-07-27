<?php

namespace App\DTOs;

/**
 * Class SettingDTO
 * @package App\DTOs
 */
class SettingDTO implements DTOInterface
{
    const KEY = 'key';
    const VALUE = 'value';
    const SERIALIZED = 'serialized';
    /**
     * @var string
     */
    private $key;
    /**
     * @var string
     */
    private $value;
    /**
     * @var bool
     */
    private $serialized;

    /**
     * SettingDTO constructor.
     * @param string $key
     * @param string $value
     * @param bool $serialized
     */
    private function __construct(string $key, string $value, bool $serialized = false)
    {

        $this->key = $key;
        $this->value = $value;
        $this->serialized = $serialized;
    }

    /**
     * @param array $data
     * @return DTOInterface
     */
    public static function fromArray(array $data): DTOInterface
    {
        return new static($data[static::KEY], $data[static::VALUE], $data[static::SERIALIZED] ?? false);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            static::KEY => $this->key,
            static::VALUE => $this->value,
            static::SERIALIZED => $this->serialized,
        ];
    }
}
