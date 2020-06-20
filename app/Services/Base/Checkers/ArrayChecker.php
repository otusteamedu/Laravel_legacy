<?php

namespace App\Services\Base\Checkers;

use App\Services\Base\Exceptions\ArrayException;

class ArrayChecker
{
    public function check($value, string $attributeName = 'value')
    {
        if (!is_array($value)) {
            throw new ArrayException($attributeName . ' must be array');
        }
    }
}
