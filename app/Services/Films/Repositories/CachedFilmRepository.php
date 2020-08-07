<?php

namespace App\Services\Films\Repositories;

use App\Models\Film;
use App\Services\Cache\CacheKeyManager;
use App\Services\Cache\Tag;
use Cache;

class CachedFilmRepository implements CachedFilmRepositoryInterface
{
    const CACHE_SEARCH_SECONDS = 60;

    /** @var FilmRepositoryInterface */
    private $filmRepository;
    /** @var CacheKeyManager */
    private $cacheKeyManager;

    public function __construct(
        FilmRepositoryInterface $filmRepository,
        CacheKeyManager $cacheKeyManager
    ) {
        $this->filmRepository = $filmRepository;
        $this->cacheKeyManager = $cacheKeyManager;
    }

    public function find(int $id)
    {
        $key = $this->cacheKeyManager->getFilmKey($id);
        return Cache::tags([Tag::CMS, Tag::FILMS])
            ->remember($key, self::CACHE_SEARCH_SECONDS, function () use ($id) {
                return $this->filmRepository->find($id);
            });
    }

    public function clearFilmCache(Film $film)
    {
        $key = $this->cacheKeyManager->getFilmKey($film->id);
        Cache::forget($key);
        $this->clearSearchCache();
    }

    public function searchByNames(string $name)
    {
        if (request()->get('no_cache')) {
            return $this->filmRepository->searchByNames($name);
        }
        $key = $this->cacheKeyManager->getSearchFilmsKey(['name' => $name]);
        return Cache::tags([Tag::CMS, Tag::FILMS])
            ->remember($key, self::CACHE_SEARCH_SECONDS, function () use ($name) {
                return $this->filmRepository->searchByNames($name);
            });
    }

    public function clearSearchCache()
    {
        Cache::tags([Tag::CMS, Tag::FILMS])->flush();
    }
}