<?php

namespace Gerfey\BattleNet\Regions\Locales\Europe;

use Gerfey\BattleNet\Regions\Locales\LocaleInterface;

class es_ES implements LocaleInterface
{
    private $locale;

    public function __construct(string $locale = 'es_ES')
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