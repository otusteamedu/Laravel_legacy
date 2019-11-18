<?php

namespace Gerfey\BattleNet\Regions\Locales\Korea;

use Gerfey\BattleNet\Regions\Locales\LocaleInterface;

class ko_KR implements LocaleInterface
{
    private $locale;

    public function __construct(string $locale = 'ko_KR')
    {
        $this->locale = $locale;
    }

    public function getRegion(): string
    {
        return 'kr';
    }

    public function getLocaleName(): string
    {
        return $this->locale;
    }
}