<?php
/**
 * Description of CachedCurrencyRepository.php
 */

namespace App\Services\Currencies\Repositories;


use App\Models\Currency;
use App\Services\Cache\CacheKeyManager;
use App\Services\Cache\Tag;
use Cache;

class CachedCurrencyRepository implements CachedCurrencyRepositoryInterface
{

    const CACHE_SEARCH_SECONDS = 60;

    /** @var CurrencyRepositoryInterface */
    private $currencyRepository;
    /** @var CacheKeyManager */
    private $cacheKeyManager;

    public function __construct(
        CurrencyRepositoryInterface $currencyRepository,
        CacheKeyManager $cacheKeyManager
    )
    {
        $this->currencyRepository = $currencyRepository;
        $this->cacheKeyManager = $cacheKeyManager;
    }

    public function find(int $id)
    {
        $key = $this->cacheKeyManager->getCountryKey($id);
        return Cache::tags([Tag::CMS, Tag::COUNTRIES])
            ->remember($key, self::CACHE_SEARCH_SECONDS, function () use ($id) {
                return $this->currencyRepository->find($id);
            });
    }

    public function clearCurrencyCache(Currency $currency)
    {
        $key = $this->cacheKeyManager->getCurrencyKey($currency->id);
        Cache::forget($key);
        $this->clearSearchCache();
    }

    public function searchByCode(string $code)
    {
        if (request()->get('no_cache')) {
            return $this->currencyRepository->searchByCode($code);
        }
        $key = $this->cacheKeyManager->getSearchCountriesKey(['code' => $code]);
        return Cache::tags([Tag::CMS, Tag::CURRENCIES])
            ->remember($key, self::CACHE_SEARCH_SECONDS, function () use ($code) {
            return $this->currencyRepository->searchByCode($code);
        });
    }

    public function all()
    {
        if (request()->get('no_cache')) {
            return $this->currencyRepository->all();
        }
        $key = $this->cacheKeyManager->getSearchCountriesKey(['all']);
        return Cache::tags([Tag::CMS, Tag::CURRENCIES])
            ->remember($key, self::CACHE_SEARCH_SECONDS, function ()  {
                return $this->currencyRepository->all();
            });
    }

    public function clearSearchCache()
    {
        Cache::tags([Tag::CMS, Tag::CURRENCIES])->flush();
    }

}
