<?php

namespace Gerfey\BattleNet\Regions\Locales\US;

use Gerfey\BattleNet\Regions\Locales\LocaleInterface;

class es_MX implements LocaleInterface
{
    private $locale;

    public function __construct(string $locale = 'es_MX')
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