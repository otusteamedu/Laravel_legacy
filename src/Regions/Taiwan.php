<?php

namespace Gerfey\BattleNet\Regions;

use Gerfey\BattleNet\Regions\Locales\LocaleInterface;
use Gerfey\BattleNet\Regions\Locales\Taiwan\zh_TW;

class Taiwan implements RegionInterface
{
    /**
     * @var zh_TW
     */
    private $locale;

    public function __construct(string $locale = 'zh_TW')
    {
        switch ($locale) {
            case "zh_TW":
                $this->locale = new zh_TW();
                break;
            default:
                $this->locale = new zh_TW();
                break;
        }
    }

    /**
     * @return LocaleInterface
     */
    public function getLocale(): LocaleInterface
    {
        return $this->locale;
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return 'https://' . $this->locale->getRegion() . '.api.blizzard.com';
    }
}