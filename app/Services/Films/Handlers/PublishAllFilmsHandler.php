<?php

namespace App\Services\Films\Handlers;

use App\Models\Film;
use App\Services\Films\Repositories\EloquentFilmRepository;
use App\Services\Films\Repositories\CachedFilmRepositoryInterface;

class PublishAllFilmsHandler
{
    /** @var EloquentFilmRepository */
    private $filmRepository;
    /** @var CachedFilmRepositoryInterface */
    private $cachedFilmRepository;

    public function __construct(
        EloquentFilmRepository $filmRepository,
        CachedFilmRepositoryInterface $cachedFilmRepository
    ) {
        $this->cachedFilmRepository = $cachedFilmRepository;
        $this->filmRepository = $filmRepository;
    }
 
    /**
     * @return array
    */
    public function handle(): array
    {
        $collectionFilms = $this->filmRepository->getNotPublishedFilms([]);

        foreach ($collectionFilms as $item) {
            $this->cachedFilmRepository->clearFilmCache($item);
        }

        $arResult = $collectionFilms->toArray();
        
        if(!empty($arResult)){
            $this->filmRepository->updateNotPublishedFilms([]);
        }

        return $arResult;
    }
}