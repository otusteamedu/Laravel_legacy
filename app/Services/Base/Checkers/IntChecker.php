<?php

namespace App\Services\Base\Checkers;

use App\Services\Base\Exceptions\IntException;

class IntChecker
{
    public function check($value, string $attributeName = 'value'): void
    {
        if (!is_int($value)) {
            throw new IntException($attributeName . ' must be integer');
        }
    }
}
