<?php


namespace App\Helpers;

use Request;

/**
 * Class LocaleHelper
 * @package App\Helpers
 */
class LocaleHelper
{

    /**
     * Получение локали из url
     *
     * @return string
     */
    public static function getLocale()
    {
        $uri = Request::path();
        $uriParams = explode('/', $uri);
        $locale =  array_shift($uriParams);

        if (empty($locale) || !in_array($locale, config('app.locale_languages'))) {
            $locale = config('app.locale');
        }

        return $locale;
    }

    /**
     * Установка локали в url
     *
     * @param string $locale
     * @return string
     */
    public static function setLocale(string $locale)
    {
        if (empty($locale) || !in_array($locale, config('app.locale_languages'))) {
            $locale = config('app.locale');
        }

        $uri = Request::path();

        $uriParams = explode('/', $uri);
        $uriParams[0] = $locale;
        $url = Request::root().'/'.implode("/", $uriParams);

        return $url;
    }
}
