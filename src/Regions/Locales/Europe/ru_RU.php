<?php

namespace Gerfey\BattleNet\Regions\Locales\Europe;

use Gerfey\BattleNet\Regions\Locales\LocaleInterface;

class ru_RU implements LocaleInterface
{
    private $locale;

    public function __construct(string $locale = 'ru_RU')
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