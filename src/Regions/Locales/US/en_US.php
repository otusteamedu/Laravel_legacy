<?php

namespace Gerfey\BattleNet\Regions\Locales\US;

use Gerfey\BattleNet\Regions\Locales\LocaleInterface;

class en_US implements LocaleInterface
{
    private $locale;

    public function __construct(string $locale = 'en_US')
    {
        $this->locale = $locale;
    }

    public function getRegion(): string
    {
        return 'us';
    }

    public function getLocaleName(): string
    {
        return $this->locale;
    }
}