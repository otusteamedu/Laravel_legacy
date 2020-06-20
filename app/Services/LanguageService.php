<?php


namespace App\Services;


use App\Services\LanguageResolver;
use Request;


class LanguageService
{
    /** @var \App\Services\LanguageResolver */
    private $languageResolver;

    /** @var \App\Services\LanguageHelper */
    private $languageHelper;

    /**
     * LanguageService constructor.
     * @param \App\Services\LanguageResolver $languageResolver
     * @param LanguageHelper $languageHelper
     */
    public function __construct(
        LanguageResolver $languageResolver,
        LanguageHelper $languageHelper
    )
    {
        $this->languageResolver = $languageResolver;
        $this->languageHelper = $languageHelper;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        $local = $this->languageResolver->getLanguageFromRequst();
        if (!$local) {
            $local = $this->languageResolver->getLanguageFromSession();
            if(!$local) {
                $local = 'ru';
            }
        }

        $this->saveLanguageToSession($local);

        \App::setLocale($local);

        return $local;
    }

    public function saveLanguageToSession($local)
    {
        $this->languageHelper->saveLocalToSession($local);
    }
}
