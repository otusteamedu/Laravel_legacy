<?php

namespace App\Services\Films\Repositories;

use App\Models\Film;
use Illuminate\Database\Eloquent\Builder;

//use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class EloquentFilmRepository implements FilmRepositoryInterface
{
    const DEFAULT_LIST_CACHE_TTL = 300;

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

    public function getList(int $limit, int $offset, int $remember = self::DEFAULT_LIST_CACHE_TTL)
    {
        $query = Film::query();
        $query->limit($limit);
        $query->offset($offset);

        $query->remember($remember)
            ->cacheTags('films');

        return $query->get();
    }

    public function search(array $filters = [])
    {
        $query = Film::query();
        $this->applyFilters($query, $filters);
        return $query->paginate();
    }

    /**
    * Поиск и выдача результата по таблице фильмов
    * @param string $name фильтр по наименованию фильма
    * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
    */
    public function searchByNames(string $name = '')
    {
        if ($name) {
            $films = Film::where('title', 'like', "%" . $name . "%")
                ->orderBy('id', 'desc')
                ->paginate();
        } else {
            $films = Film::orderBy('id', 'desc')->paginate();
        }
        return $films;
    }

    public function createFromArray(array $data): Film
    {
    
        return Film::create($data);
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