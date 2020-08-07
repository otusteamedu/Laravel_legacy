<?php

namespace App\Services\Films\Repositories;

use App\Models\Film;

interface CachedFilmRepositoryInterface
{
    public function searchByNames(string $name);

    public function clearSearchCache();

    public function find(int $id);

    public function clearFilmCache(Film $film);
}