<?php

namespace App\Services\Helpers\Locale;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Cookie as HttpCookie;

class Locale
{
    const COOKIE_TIME = 12 * 60 * 30;
    const USER_LOCALE = 'user_locale';
    const RU = 'ru';
    const EN = 'en';

    /**
     * @return array
     */
    public function getAvailableLocales(): array
    {
        return [
            static::RU,
            static::EN,
        ];
    }

    /**
     * @param string $locale
     * @return bool
     */
    public function localeIsAvailable(string $locale): bool
    {
        return in_array($locale, $this->getAvailableLocales());
    }

    /**
     * @param string $locale
     * @return HttpCookie
     */
    public function setLocale(string $locale): HttpCookie
    {
        if (!$this->localeIsAvailable($locale)) {
            throw new LocaleException($locale . ' is not available');
        }

        App::setLocale($locale);

        return cookie(static::USER_LOCALE, $locale, static::COOKIE_TIME);
    }

    /**
     * @return string|null
     */
    public function getLocate(): ?string
    {
        return Cookie::get(static::USER_LOCALE);
    }
}
