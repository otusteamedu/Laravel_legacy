<?php
/**
 * Description of CachedCountryRepository.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Countries\Repositories;


use App\Services\Cache\CacheKeyManager;
use App\Services\Cache\Tag;
use Cache;
use Illuminate\Database\Eloquent\Collection;

class CachedCountryRepository implements CachedCountryRepositoryInterface
{

    const CACHE_SEARCH_SECONDS = 60;

    /** @var CountryRepositoryInterface */
    private $countryRepository;
    /** @var CacheKeyManager */
    private $cacheKeyManager;

    public function __construct(
        CountryRepositoryInterface $countryRepository,
        CacheKeyManager $cacheKeyManager
    )
    {
        $this->countryRepository = $countryRepository;
        $this->cacheKeyManager = $cacheKeyManager;
    }

    public function getBy(array $filters = [], array $with = [], ?int $limit = null, ?int $offset = null): Collection
    {
        $searchData = array_merge($filters, [
            'limit' => $limit,
            'offset' => $offset,
        ]);
        $key = $this->cacheKeyManager->getSearchCountriesKey($searchData);

        return Cache::tags([Tag::CMS, Tag::COUNTRIES])
            ->remember($key, self::CACHE_SEARCH_SECONDS, function () use ($filters, $with, $limit, $offset) {
                return $this->countryRepository->getBy($filters, $with, $limit, $offset);
            });
    }

    public function search(array $filters = [], array $with = [])
    {
        $key = $this->cacheKeyManager->getSearchCountriesKey($filters);

        return Cache::tags([Tag::CMS, Tag::COUNTRIES])
            ->remember($key, self::CACHE_SEARCH_SECONDS, function () use ($filters, $with) {
            return $this->countryRepository->search($filters, $with);
        });
    }

    public function clearSearchCache()
    {
        Cache::tags([Tag::CMS, Tag::COUNTRIES])->flush();
    }

}
