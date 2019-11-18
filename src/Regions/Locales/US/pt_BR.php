<?php

namespace Gerfey\BattleNet\Regions\Locales\US;

use Gerfey\BattleNet\Regions\Locales\LocaleInterface;

class pt_BR implements LocaleInterface
{
    private $locale;

    public function __construct(string $locale = 'pt_BR')
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