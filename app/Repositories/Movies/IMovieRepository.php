<?php


namespace App\Repositories\Movies;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Collection;

interface IMovieRepository
{
    public function find(int $id);
    public function search(array $filters = []) : Collection;
    public function createFromArray(array $data): Movie;
    public function updateFromArray(Movie $person, array $data): Movie;
    public function remove(Movie $person);
}
