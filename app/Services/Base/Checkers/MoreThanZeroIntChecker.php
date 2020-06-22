<?php

namespace App\Services\Base\Checkers;

use App\Services\Base\Checkers\IntChecker;
use App\Services\Base\Exceptions\MoreThanZeroIntException;

class MoreThanZeroIntChecker
{
    protected $intChecker;

    public function __construct(
        IntChecker $intChecker
    ) {
        $this->intChecker = $intChecker;
    }

    public function check($value, string $attributeName = 'value')
    {
        $this->intChecker->check($value);

        if ($value <= 0) {
            throw new MoreThanZeroIntException($attributeName . ' must be more than zero');
        }
    }
}
