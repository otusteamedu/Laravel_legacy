<?php

namespace App\Listeners\Cache\Film;

use App\Services\Films\Repositories\CachedFilmRepositoryInterface;
use App\Services\Events\Models\Film\FilmUpdated;

class ClearFilmUpdateCache
{

    /** @var CachedFilmRepositoryInterface */
    private $cachedFilmRepository;

    /**
     * ClearCountryCache constructor.
     * @param CachedFilmRepositoryInterface $cachedFilmRepository
     */
    public function __construct(
        CachedFilmRepositoryInterface $cachedFilmRepository
    ) {
        $this->cachedFilmRepository = $cachedFilmRepository;
    }

    /**
     * @param FilmSaved $filmSaved
     */
    public function handle(FilmUpdated $filmUpdated)
    {
        $this->cachedFilmRepository->clearFilmCache(
            $filmUpdated->getFilm()
        );

        $this->cachedFilmRepository->clearSearchCache();
        $this->cachedFilmRepository->searchByNames('');
    }
}