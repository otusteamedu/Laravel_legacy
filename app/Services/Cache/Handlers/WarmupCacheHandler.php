<?php
/**
 * Description of WarmupCacheHandler.php
 * Хендлер для прогрева кэша
 */

namespace App\Services\Cache\Handlers;

use App\Services\Cache\CacheKeyManager;
use App\Services\Cache\Tag;
use App\Services\Countries\Repositories\CachedCountryRepository;
use App\Services\Countries\Repositories\CachedCountryRepositoryInterface;
use App\Services\Currencies\Repositories\CachedCurrencyRepository;
use App\Services\Currencies\Repositories\CachedCurrencyRepositoryInterface;
use App\Services\Income\Repositories\CachedIncomeRepository;
use App\Services\Income\Repositories\CachedIncomeRepositoryInterface;
use App\Services\Users\Repositories\UserRepositoryInterface;
use Cache;

class WarmupCacheHandler
{
    const CACHE_SEARCH_SECONDS = 60;
    private $cacheKeyManager;
    private $cachedCountryRepository;
    private $cachedCurrencyRepository;
    private $cachedIncomeRepository;
    public function __construct(CacheKeyManager $cacheKeyManager,
                                CachedCountryRepositoryInterface $cachedCountryRepository,
                                CachedCurrencyRepositoryInterface $cachedCurrencyRepository,
                                CachedIncomeRepositoryInterface $cachedIncomeRepository
    )
    {
        $this->cacheKeyManager = $cacheKeyManager;
        $this->cachedCountryRepository = $cachedCountryRepository;
        $this->cachedCurrencyRepository = $cachedCurrencyRepository;
        $this->cachedIncomeRepository = $cachedIncomeRepository;
    }

    /**
     * Прогрев кэша CMS
     */
    public function warmUpForCms()
    {
        Cache::tags([Tag::CMS])->flush();
        $this->cachedCountryRepository->searchByNames('');
        $this->cachedCurrencyRepository->all();
        $this->cachedCurrencyRepository->searchByCode('');
    }

    /**
     * Прогрев кэша у пользователей
     */
    public function warmUpForUsers()
    {
        $this->cachedIncomeRepository->clearSearchCache();
        $usersIds = $this->cachedIncomeRepository->getIncomeUsersIds();
        foreach ($usersIds as $userId) {
            $this->cachedIncomeRepository->search('', $userId);
            $this->cachedIncomeRepository->sum('', $userId);
        }
    }
}
