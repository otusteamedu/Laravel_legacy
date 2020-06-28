<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;

class LocaleService
{

    /**
     * @param string $locale
     * @return bool
     */
    public static function isSupported(string $locale)
    {
        return in_array($locale, config('app.locale_languages'));
    }

}
