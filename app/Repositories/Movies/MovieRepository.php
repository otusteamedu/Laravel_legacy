<?php


namespace App\Repositories\Movies;


use App\Models\Movie;
use Illuminate\Database\Eloquent\Collection;

class MovieRepository implements IMovieRepository
{
    public function find(int $id)
    {
        return Movie::find($id);
    }
    public function search(array $filters = []): Collection
    {
        //return Country::paginate();
        return Movie::all();
    }
    public function createFromArray(array $data): Movie
    {
        $movie = new Movie();
        return $movie->create($data);
    }
    public function updateFromArray(Movie $movie, array $data): Movie
    {
        $movie->update($data);
        return $movie;
    }
    public function remove(Movie $movie) {
        $movie->delete();
    }
}
