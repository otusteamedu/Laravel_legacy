<?php

namespace Gerfey\BattleNet\Regions\Locales\Europe;

use Gerfey\BattleNet\Regions\Locales\LocaleInterface;

class it_IT implements LocaleInterface
{
    private $locale;

    public function __construct(string $locale = 'it_IT')
    {
        $this->locale = $locale;
    }

    public function getRegion(): string
    {
        return 'eu';
    }

    public function getLocaleName(): string
    {
        return $this->locale;
    }
}