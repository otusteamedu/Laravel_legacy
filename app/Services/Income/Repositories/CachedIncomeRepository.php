<?php
/**
 * Description of CachedIncomeRepository.php
 */

namespace App\Services\Income\Repositories;


use App\Models\Income;
use App\Services\Cache\CacheKeyManager;
use App\Services\Cache\Tag;
use Cache;

class CachedIncomeRepository implements CachedIncomeRepositoryInterface
{

    const CACHE_SEARCH_SECONDS = 60;

    /** @var IncomeRepositoryInterface */
    private $incomeRepository;
    /** @var CacheKeyManager */
    private $cacheKeyManager;

    public function __construct(
        IncomeRepositoryInterface $incomeRepository,
        CacheKeyManager $cacheKeyManager
    )
    {
        $this->incomeRepository = $incomeRepository;
        $this->cacheKeyManager = $cacheKeyManager;
    }


    public function search($search, $userId)
    {
        if (!empty($search) || request()->get('no_cache')) {
            // для оптимизации кэшируем только без фильтров
            return $this->incomeRepository->search($search, $userId);
        }
        $key = $this->cacheKeyManager->getSearchCountriesKey(['search' => $search, 'user_id' => $userId]);
        return Cache::tags([Tag::INCOMES])
            ->remember($key, self::CACHE_SEARCH_SECONDS, function () use ($search, $userId) {
            return $this->incomeRepository->search($search, $userId);
        });
    }

    public function sum($search, $userId): int
    {
        if (!empty($search) || request()->get('no_cache')) {
            // для оптимизации кэшируем только без фильтров
            return $this->incomeRepository->sum($search, $userId);
        }
        $key = $this->cacheKeyManager->getSearchCountriesKey(['search' => $search, 'user_id' => $userId]);
        return Cache::tags([Tag::INCOMES_SUM])
            ->remember($key, self::CACHE_SEARCH_SECONDS, function () use ($search, $userId) {
                return $this->incomeRepository->sum($search, $userId);
            });
    }


    public function clearSearchCache()
    {
        Cache::tags([Tag::INCOMES])->flush();
        Cache::tags([Tag::INCOMES_SUM])->flush();
    }

}
