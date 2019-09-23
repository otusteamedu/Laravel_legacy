<?php


namespace App\Repositories\Genres;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Collection;

interface IGenreRepository
{
    public function find(int $id);
    public function search(array $filters = []): Collection;
    public function createFromArray(array $data): Genre;
    public function updateFromArray(Genre $genre, array $data);
    public function remove(Genre $genre);
}
