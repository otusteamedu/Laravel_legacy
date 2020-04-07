<?php

namespace App\Services\Locales\Resolvers;

use App\Services\Languages\LanguagesService;


class AvailableLocaleListResolver
{
    private $languagesService;

    public function __construct(LanguagesService $languagesService)
    {
        $this->languagesService = $languagesService;
    }

    public function resolve(): array {
        $availableLocalesList = [];
        $languagePaginator = $this->languagesService->getAllLanguagePaginator();

        foreach ($languagePaginator as $language) {
            $availableLocalesList[] = $language->code;
        }

        return $availableLocalesList;
    }
}
