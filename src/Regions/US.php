<?php

namespace Gerfey\BattleNet\Regions;

use Gerfey\BattleNet\Regions\Locales\LocaleInterface;
use Gerfey\BattleNet\Regions\Locales\US\{ en_US, es_MX, pt_BR };

class US implements RegionInterface
{
    /**
     * @var en_US
     */
    private $locale;

    public function __construct(string $locale = 'en_US')
    {
        switch ($locale) {
            case "en_US":
                $this->locale = new en_US();
                break;
            case "es_MX":
                $this->locale = new es_MX();
                break;
            case "pt_BR":
                $this->locale = new pt_BR();
                break;
            default:
                $this->locale = new en_US();
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