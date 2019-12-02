<?php

namespace Gerfey\BattleNet\Regions;


use Gerfey\BattleNet\Regions\Locales\Korea\ko_KR;
use Gerfey\BattleNet\Regions\Locales\LocaleInterface;

class Korea implements RegionInterface
{
    /**
     * @var ko_KR
     */
    private $locale;

    public function __construct(string $locale = 'ko_KR')
    {
        switch ($locale) {
            case "ko_KR":
                $this->locale = new ko_KR();
                break;
            default:
                $this->locale = new ko_KR();
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