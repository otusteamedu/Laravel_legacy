<?php

namespace Gerfey\BattleNet\Regions\Locales;

interface LocaleInterface
{
    public function getLocaleName(): string;

    public function getRegion(): string;
}