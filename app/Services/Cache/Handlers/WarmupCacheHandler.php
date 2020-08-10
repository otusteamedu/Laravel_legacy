<?php
/**
 * Description of WarmupCacheHandler.php
 * Хендлер для прогрева кэша
 */

namespace App\Services\Cache\Handlers;

use App\Services\Cache\CacheKeyManager;
use App\Services\Cache\Tag;
//use App\Services\Films\Repositories\CachedFilmRepository;
use App\Services\Films\Repositories\CachedFilmRepositoryInterface;
use Cache;

class WarmupCacheHandler
{
    const CACHE_SEARCH_SECONDS = 60;

    private $cacheKeyManager;
    /** @var CachedFilmRepositoryInterface */
    private $cachedFilmRepository;

    public function __construct(
        CacheKeyManager $cacheKeyManager,
        CachedFilmRepositoryInterface $cachedFilmRepository
    ) {
        $this->cacheKeyManager = $cacheKeyManager;
        $this->cachedFilmRepository = $cachedFilmRepository;
    }

    /**
     * Прогрев кэша CMS тк кеш только есть у Фильмов
     * то пока данный handler не нужен
     *   public function warmUpForCms()
     *   {
     *       Cache::tags([Tag::CMS])->flush();
     *       $this->cachedFilmRepository->searchByNames('');
     *   }
   */
    /**
     * Прогрев кэша у фильмов
    */
    public function warmUpForFilms()
    {
        $this->cachedFilmRepository->clearSearchCache();
        $this->cachedFilmRepository->searchByNames('');
    }
}