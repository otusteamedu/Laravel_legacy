<?php


namespace App\Services;

use \Illuminate\Support\Facades\Request;

class LanguageResolver
{
    public static $languages = ['en', 'ru'];

    public static function getLanguageFromRequst() {
        $uri = Request::path();

        $segmentsURI = explode('/', $uri);

        if (!empty($segmentsURI[0]) && in_array($segmentsURI[0], self::$languages)) {
            return $segmentsURI[0];
        }
    }

    /**
     * @return array
     */
    public static function getLanguages(string $lang): string
    {
        $url = Request::path();

        $segmentsURI = explode('/', $url);

        if(in_array($lang, self::$languages)){
            $segmentsURI[0] = $lang;
            $url = "/" . implode("/", $segmentsURI);
        } else {
            throw new LanguageExepction("Language '" . $lang . "' not founded");
        }

        return $url;
    }
}
