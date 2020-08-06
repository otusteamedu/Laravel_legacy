<?php

namespace App\Services\Films\Repositories;

use App\Models\Film;
use Illuminate\Database\Eloquent\Builder;

//use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class EloquentFilmRepository implements FilmRepositoryInterface
{
    /*
    * выводим без пагинации для тестирования кеширования
    */
    public function index()
    {
        return Film::All();
    }
    
    public function find(int $id)
    {
        return Film::find($id);
    }

    public function search(array $filters = [])
    {
        $query = Film::query();
        $this->applyFilters($query, $filters);
        return $query->paginate();
    }

    public function createFromArray(array $data): Film
    {
        $film = new Film();
        $film->create($data);
        return $film;
    }

    public function updateFromArray(Film $film, array $data)
    {
        $film->update($data);
        return $film;
    }

    private function applyFilters(Builder $builder, array $filters)
    {
        if (isset($filters['name'])) {
            $builder->where('name', $filters['name']);
        }
    }
}