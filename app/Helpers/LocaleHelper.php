<?php


namespace App\Helpers;

use App\Services\LocaleService;
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
        $locale = array_shift($uriParams);

        if (!LocaleService::isSupported($locale)) {
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
        if (!LocaleService::isSupported($locale)) {
            $locale = config('app.locale');
        }

        $uri = Request::path();

        $uriParams = explode('/', $uri);
        $uriParams[0] = $locale;
        $url = Request::root() . '/' . implode("/", $uriParams);

        return $url;
    }
}
