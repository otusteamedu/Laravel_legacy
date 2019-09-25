<?php


namespace App\Repositories\Genres;


use App\Models\Genre;
use Illuminate\Database\Eloquent\Collection;

class GenreRepository implements IGenreRepository
{
    public function find(int $id)
    {
        return Genre::find($id);
    }
    public function search(array $filters = []): Collection
    {
        //return Country::paginate();
        return Genre::all();
    }
    public function createFromArray(array $data): Genre
    {
        $genre = new Genre();
        return $genre->create($data);
    }
    public function updateFromArray(Genre $genre, array $data)
    {
        $genre->update($data);
        return $genre;
    }
    public function remove(Genre $genre) {
        $genre->delete();
    }
}
