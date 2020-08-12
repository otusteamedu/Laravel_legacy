<?php

namespace App\Listeners\Cache\Film;

use App\Services\Films\Repositories\CachedFilmRepositoryInterface;
use App\Services\Events\Models\Film\FilmSaved;

class ClearFilmSaveCache
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
    public function handle(FilmSaved $filmSaved)
    {
        $this->cachedFilmRepository->clearFilmCache(
            $filmSaved->getFilm()
        );
    }
}