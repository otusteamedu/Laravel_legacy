<?php


namespace App\Services;

use \Illuminate\Support\Facades\Request;
use phpDocumentor\Reflection\Types\Void_;

class LanguageResolver
{
    public static $languages = ['en', 'ru'];

    /**
     * @return string|null
     */
    public static function getLanguageFromRequst() {
        $url = Request::path();

        $segmentsURI = explode('/', $url);

        if (!empty($segmentsURI[0]) && in_array($segmentsURI[0], self::$languages)) {
            return $segmentsURI[0];
        } else {
            return false;
        }
    }

    /**
     * @return bool|mixed
     */
    public static function getLanguageFromSession()
    {
        if(\Session::has('locale')) {
            return \Session::get('locale');
        } else {
            return false;
        }
    }

    /**
     * @return string
     */
    public static function getLanguage()
    {
        $languageService = new \App\Services\LanguageService(
            new \App\Services\LanguageResolver(),
            new \App\Services\LanguageHelper()
        );

        return $languageService->getLanguage();
    }

    public static function getLanguageUrl($local)
    {
        $url = Request::path();

        $segmentsURI = explode('/', $url);

        if (!empty($segmentsURI[0]) && in_array($segmentsURI[0], self::$languages)) {
            $segmentsURI[0] = $local;
        }

        return implode($segmentsURI);
    }
}
