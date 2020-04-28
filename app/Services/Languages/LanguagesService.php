<?php

namespace App\Services\Languages;

use App\Services\Languages\Repositories\CacheLanguageRepositoryInterface;

class LanguagesService
{
    private $cacheLanguageRepositoryInterface;

    public function __construct(CacheLanguageRepositoryInterface $cacheLanguageRepositoryInterface)
    {
        $this->cacheLanguageRepositoryInterface = $cacheLanguageRepositoryInterface;
    }

    public function getAllLanguagePaginator() { // @ToDo: изменить на коллекции
        $languageList = $this->cacheLanguageRepositoryInterface->search();

        return $languageList;
    }
}
