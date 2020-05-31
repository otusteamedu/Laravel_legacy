<?php


namespace App\Services;


use App\Services\LanguageResolver;


class LanguageService
{
    /** @var \App\Services\LanguageResolver */
    private $languageResolver;

    public function __construct(
        LanguageResolver $languageResolver
    )
    {
        $this->languageResolver = $languageResolver;
    }

    public function getLanguageFromRequst(){
        return $this->languageResolver->getLanguageFromRequst();
    }
}
