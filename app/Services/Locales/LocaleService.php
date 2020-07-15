<?php

namespace App\Services\Locales;

use App\Services\Helpers\Locale\Locale;
use Symfony\Component\HttpFoundation\Cookie;

class LocaleService
{
    /**
     * @var Locale
     */
    protected $locale;

    /**
     * LocaleService constructor.
     * @param Locale $locale
     */
    public function __construct(Locale $locale)
    {
        $this->locale = $locale;
    }

    public function setLocale(string $locale): Cookie
    {
        return $this->locale->setLocale($locale);
    }

    public function getLocale(): ?string
    {
        return $this->locale->getLocate();
    }
}
