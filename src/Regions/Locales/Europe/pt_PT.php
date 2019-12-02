<?php

namespace Gerfey\BattleNet\Regions\Locales\Europe;

use Gerfey\BattleNet\Regions\Locales\LocaleInterface;

class pt_PT implements LocaleInterface
{
    private $locale;

    public function __construct(string $locale = 'pt_PT')
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