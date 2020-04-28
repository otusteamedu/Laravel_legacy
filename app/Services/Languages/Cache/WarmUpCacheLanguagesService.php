<?php

namespace App\Services\Languages\Cache;


use App\Models\Language;
use App\Services\Languages\Repositories\CacheLanguageRepositoryInterface;
use App\Services\Languages\Repositories\LanguageRepositoryInterface;

class WarmUpCacheLanguagesService
{
    /**
     * @var LanguageRepositoryInterface
     */
    private $languageRepository;
    /**
     * @var CacheLanguageRepositoryInterface
     */
    private $cacheLanguageRepository;

    public function __construct(
        LanguageRepositoryInterface $languageRepository,
        CacheLanguageRepositoryInterface $cacheLanguageRepository
    )
    {
        $this->languageRepository = $languageRepository;
        $this->cacheLanguageRepository = $cacheLanguageRepository;
    }

    public function warmAll()
    {
        $this->warmSearch();
        $this->warmShowLanguages();
    }

    public function warmSearch()
    {
        $this->cacheLanguageRepository->search();
    }

    public function warmShowLanguages()
    {
        $languages = $this->languageRepository->search();

        foreach ($languages as $language) {
            $this->warmShowLanguage($language);
        }
    }

    public function warmShowLanguage(Language $language)
    {
        $this->cacheLanguageRepository->find($language->id);
    }
}
