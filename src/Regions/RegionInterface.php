<?php

namespace Gerfey\BattleNet\Regions;

use Gerfey\BattleNet\Regions\Locales\LocaleInterface;

interface RegionInterface
{
    public function getLocale(): LocaleInterface;

    public function getBaseUrl(): string;
}