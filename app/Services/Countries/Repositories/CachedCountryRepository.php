<?php
/**
 * Description of CachedCountryRepository.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Countries\Repositories;


use App\Models\Country;
use App\Services\Cache\CacheKeyManager;
use App\Services\Cache\Tag;
use Cache;

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

    public function find(int $id)
    {
        $key = $this->cacheKeyManager->getCountryKey($id);
        return Cache::tags([Tag::CMS, Tag::COUNTRIES])
            ->remember($key, self::CACHE_SEARCH_SECONDS, function () use ($id) {
                return $this->countryRepository->find($id);
            });
    }

    public function clearCountryCache(Country $country)
    {
        $key = $this->cacheKeyManager->getCountryKey($country->id);
        Cache::forget($key);
        $this->clearSearchCache();
    }

    public function searchByNames(string $name)
    {
        if (request()->get('no_cache')) {
            return $this->countryRepository->searchByNames($name);
        }
        $key = $this->cacheKeyManager->getSearchCountriesKey(['name' => $name]);
        return Cache::tags([Tag::CMS, Tag::COUNTRIES])
            ->remember($key, self::CACHE_SEARCH_SECONDS, function () use ($name) {
            return $this->countryRepository->searchByNames($name);
        });
    }

    public function clearSearchCache()
    {
        Cache::tags([Tag::CMS, Tag::COUNTRIES])->flush();
    }

}
