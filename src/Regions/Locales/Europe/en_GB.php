<?php

namespace Gerfey\BattleNet\Regions\Locales\Europe;

use Gerfey\BattleNet\Regions\Locales\LocaleInterface;

class en_GB implements LocaleInterface
{
    private $locale;

    public function __construct(string $locale = 'en_GB')
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