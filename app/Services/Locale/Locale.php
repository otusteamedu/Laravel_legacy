<?php


namespace App\Services\Locale;


use phpDocumentor\Reflection\Types\Self_;

class Locale
{

    const RU ='ru';
    const EN ='en';

   private static $supported = [self::EN, self::RU];

    public static function isSupported( string $locale)
    {
        return in_array($locale, self::$supported);
    }

    public static function setLocale($locale)
    {

        \App::setLocale($locale);
    }

}
