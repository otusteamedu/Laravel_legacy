<?php

namespace Gerfey\BattleNet\Regions\Locales\Taiwan;

use Gerfey\BattleNet\Regions\Locales\LocaleInterface;

class zh_TW implements LocaleInterface
{
    private $locale;

    public function __construct(string $locale = 'zh_TW')
    {
        $this->locale = $locale;
    }

    public function getRegion(): string
    {
        return 'tw';
    }

    public function getLocaleName(): string
    {
        return $this->locale;
    }
}