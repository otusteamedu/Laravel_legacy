<?php

namespace Gerfey\BattleNet\Regions\Locales\China;

use Gerfey\BattleNet\Regions\Locales\LocaleInterface;

class zh_CN implements LocaleInterface
{
    private $locale;

    public function __construct(string $locale = 'zh_CN')
    {
        $this->locale = $locale;
    }

    public function getRegion(): string
    {
        return 'gateway';
    }

    public function getLocaleName(): string
    {
        return $this->locale;
    }
}