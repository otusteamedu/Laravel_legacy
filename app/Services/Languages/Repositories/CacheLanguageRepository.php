<?php

namespace App\Services\Languages\Repositories;

use App\Models\Language;
use App\Services\Cache\Tag;
use App\Services\Languages\Repositories\CacheLanguageRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class CacheLanguageRepository
 * @package App\Services\Languages\Repositories
 */
class CacheLanguageRepository implements CacheLanguageRepositoryInterface
{
    private $languageRepository;

    public function __construct(
        LanguageRepositoryInterface $languageRepository
    ) {
        $this->languageRepository = $languageRepository;
    }

    public function find(int $languageId)
    {
        $languageCacheKey = 'language_' . $languageId;

        return \Cache::tags([Tag::PUBLIC, Tag::LANGUAGES])->remember(
            $languageCacheKey,
            Carbon::now()->addSeconds(\Config::get('cache.cache_time.language_detail')),
            function () use ($languageId) {
                $this->languageRepository->find($languageId);
            }
        );
    }

    public function search(array $filters = [],  array $with = []): ?LengthAwarePaginator
    {
        $languagePaginateCacheKey = 'languagePaginate_' . serialize($filters);
        $languagePaginator = \Cache::tags([Tag::PUBLIC, Tag::LANGUAGES])->remember(
            $languagePaginateCacheKey,
            Carbon::now()->addSeconds(\Config::get('cache.cache_time.language_list')),
            function () use ($filters) {
                return $this->languageRepository->search();
            }
        );

        return $languagePaginator;
    }

    public function clear() {
        \Cache::tags([Tag::PUBLIC, Tag::LANGUAGES])->flush();
    }
}
