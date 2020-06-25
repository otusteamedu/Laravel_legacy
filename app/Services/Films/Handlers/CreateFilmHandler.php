<?php

namespace App\Services\Films\Handlers;


use App\Models\Film;
use App\Services\Films\Repositories\EloquentFilmRepository;

class CreateFilmHandler
{

    private $filmRepository;

    public function __construct(
        EloquentFilmRepository $filmRepository
    )
    {
        $this->filmRepository = $filmRepository;
    }

    /**
     * @param array $data
     * @return Film
     */
    public function handle(array $data): Film
    {
        return $this->filmRepository->createFromArray($data);
    }

}
