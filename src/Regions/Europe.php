<?php

namespace Gerfey\BattleNet\Regions;

use Gerfey\BattleNet\Regions\Locales\Europe\{ de_DE, en_GB, es_ES, fr_FR, it_IT, pt_PT, ru_RU };
use Gerfey\BattleNet\Regions\Locales\LocaleInterface;

class Europe implements RegionInterface
{
    /**
     * @var ru_RU
     */
    private $locale;

    public function __construct(string $locale = 'ru_RU')
    {
        switch ($locale) {
            case "ru_RU":
                $this->locale = new ru_RU();
                break;
            case "en_GB":
                $this->locale = new en_GB();
                break;
            case "es_ES":
                $this->locale = new es_ES();
                break;
            case "fr_FR":
                $this->locale = new fr_FR();
                break;
            case "de_DE":
                $this->locale = new de_DE();
                break;
            case "pt_PT":
                $this->locale = new pt_PT();
                break;
            case "it_IT":
                $this->locale = new it_IT();
                break;
            default:
                $this->locale = new ru_RU();
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