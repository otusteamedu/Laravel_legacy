<?php

namespace App\Services\Films\Handlers;

use App\Models\Film;
use App\Services\Films\Repositories\EloquentFilmRepository;
use App\Services\Films\Repositories\CachedFilmRepositoryInterface;

class PublishFilmsHandler
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
     * @param array $data
     * @return array
    */
    public function handle(array $data): array
    {

        $collectionFilms = $this->filmRepository->getNotPublishedFilms($data);
        
        foreach ($collectionFilms as $item) {
            $this->cachedFilmRepository->clearFilmCache($item);
        }

        $arResult = $collectionFilms->toArray();

        $this->filmRepository->updateNotPublishedFilms($data);

        return $arResult;
    }
}