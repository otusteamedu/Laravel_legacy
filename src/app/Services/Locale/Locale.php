<?php

namespace App\Services\Locale;

/**
 * Локализации
 * Class Locale
 * @package App\Services\Locale
 */
class Locale
{
    /**
     * Ключ в сессии где хранится локаль
     */
    const LOCALE_SESSION_KEY = 'locale';

    /**
     * Массив с поддерживаемыми локалями
     * @var array
     */
    private static $supported = [
        "en",
        "ru"
    ];

    /**
     * Проверка на поддерживаемость локали
     * @param string $locale
     * @return bool
     */
    public static function isSupported(string $locale): bool
    {
        return in_array($locale, self::$supported);
    }

}
