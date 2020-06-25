<?php

namespace App\Services\Films\Repositories;


use App\Models\Film;

interface FilmRepositoryInterface
{

    public function find(int $id);

    public function search(array $filters = []);

    public function createFromArray(array $data): Film;

    public function updateFromArray(Film $film, array $data);

}
