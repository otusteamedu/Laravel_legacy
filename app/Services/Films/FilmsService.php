<?php

namespace App\Services\Films;

use App\Models\Film;
use App\Services\Films\Handlers\CreateFilmHandler;
use App\Services\Films\Handlers\IndexFilmHandler;
use App\Services\Films\Repositories\FilmRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use App\Services\Films\Repositories\CachedFilmRepositoryInterface;

class FilmsService
{

    /** @var FilmRepositoryInterface */
    private $filmRepository;
    /** @var CreateFilmHandler */
    private $createFilmHandler;
    /** @var CachedFilmRepositoryInterface */
    private $cachedFilmRepository;

    public function __construct(
        IndexFilmHandler $indexFilmHandler,
        CreateFilmHandler $createFilmHandler,
        FilmRepositoryInterface $filmRepository,
        CachedFilmRepositoryInterface $cachedFilmRepository
    ) {
        $this->indexFilmHandler = $indexFilmHandler;
        $this->createFilmHandler = $createFilmHandler;
        $this->filmRepository = $filmRepository;
        $this->cachedFilmRepository = $cachedFilmRepository;
    }

    /**
     * @param int $id
     * @return Film|null
     */
    public function findFilmCached(int $id)
    {
        return $this->cachedFilmRepository->find($id);
    }

    public function indexFilm()
    {
        return $this->indexFilmHandler->handle();
    }

    /**
     * @param int $id
     * @return Film|null
     */
    public function findFilm(int $id)
    {
        return $this->filmRepository->find($id);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchFilms(): LengthAwarePaginator
    {
        return $this->filmRepository->search();
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Collection
     */
    public function getFilms(int $limit, int $offset): Collection
    {
        return $this->filmRepository->getList($limit, $offset);
    }

    /**
     * @param array $data
     * @return Film
     */
    public function createFilm(array $data): Film
    {
        return $this->createFilmHandler->handle($data);
    }

    /**
     * @param Film $film
     * @param array $data
     * @return Film
     */
    public function updateFilm(Film $film, array $data): Film
    {
        return $this->filmRepository->updateFromArray($film, $data);
    }
}