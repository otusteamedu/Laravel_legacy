<?php

namespace App\Services\Films;


use App\Models\Film;
use App\Services\Films\Handlers\CreateFilmHandler;
use App\Services\Films\Repositories\FilmRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FilmsService
{

    /** @var FilmRepositoryInterface */
    private $filmRepository;
    /** @var CreateFilmHandler */
    private $createFilmHandler;

    public function __construct(
        CreateFilmHandler $createFilmHandler,
        FilmRepositoryInterface $filmRepository
    )
    {
        $this->createFilmHandler = $createFilmHandler;
        $this->filmRepository = $filmRepository;
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
