<?php

namespace App\Services\Languages;

use App\Services\Languages\Repositories\LanguageRepositoryInterface;

class LanguagesService
{
    private $languageRepository;

    public function __construct(LanguageRepositoryInterface $languageRepository)
    {
        $this->languageRepository = $languageRepository;
    }

    public function getAllLanguagePaginator() { // @ToDo: изменить на коллекции
        $languageList = $this->languageRepository->search();

        return $languageList;
    }
}
