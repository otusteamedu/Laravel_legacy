<?php

namespace Gerfey\BattleNet\Regions;

use Gerfey\BattleNet\Regions\Locales\China\zh_CN;
use Gerfey\BattleNet\Regions\Locales\LocaleInterface;

class China implements RegionInterface
{
    /**
     * @var zh_CN
     */
    private $locale;

    public function __construct(string $locale = 'zh_CN')
    {
        switch ($locale) {
            case "zh_CN":
                $this->locale = new zh_CN();
                break;
            default:
                $this->locale = new zh_CN();
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
        return 'https://' . $this->locale->getRegion() . '.battlenet.com.cn';
    }
}