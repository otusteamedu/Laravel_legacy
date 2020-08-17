<?php

namespace App\Services\Films\Repositories;

use App\Models\Film;

//use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface FilmRepositoryInterface
{
    public function index();

    public function find(int $id);

    public function getList(int $limit, int $offset);

    public function getNotPublishedFilms(array $data): array;

    public function updateNotPublishedFilms(array $data): int;

    public function searchByNames(string $name = '');

    public function search(array $filters = []);

    public function createFromArray(array $data): Film;

    public function updateFromArray(Film $film, array $data);
}