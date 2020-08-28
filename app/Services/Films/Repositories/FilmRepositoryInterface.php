<?php

namespace App\Services\Films\Repositories;

use App\Models\Film;
use Illuminate\Database\Eloquent\Collection;

interface FilmRepositoryInterface
{
    public function index();

    public function find(int $id);

    public function getBy(array $filters = [], ?int $limit = null, ?int $offset = null): Collection;

    public function getList(int $limit, int $offset);

    public function getNotPublishedFilms(array $data): Collection;

    public function updateNotPublishedFilms(array $data): int;

    public function searchByNames(string $name = '');

    public function search(array $filters = []);

    public function createFromArray(array $data): Film;

    public function updateFromArray(Film $film, array $data);
}