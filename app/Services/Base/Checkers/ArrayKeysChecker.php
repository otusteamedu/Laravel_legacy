<?php

namespace App\Services\Base\Checkers;

use App\Services\Base\Exceptions\ArrayKeysException;

class ArrayKeysChecker
{
    public function check(array $array, array $keys, string $attributeName = 'array'): void
    {
        foreach ($keys as $key) {
            if (!isset($array[$key])) {
                throw new ArrayKeysException($attributeName . ' must contain ' . $key);
            }
        }
    }
}
