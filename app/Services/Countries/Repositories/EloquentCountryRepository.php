<?php
/**
 * Eloquent репозиторий для стран
 */

namespace App\Services\Countries\Repositories;

use App\Models\Country;

class EloquentCountryRepository implements CountryRepositoryInterface
{

    public function find(int $id)
    {
        return Country::find($id)->toArray();
    }

    /**
     * Поиск и выдача резултата по таблице стран
     * @param array $filters
     * @param bool $like сравнивать по неполному соответствию
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search(array $filters = [], bool $like = false)
    {
        if ($like && isset($filters['name'])) {
            $countries = Country::where('name', 'like', "%" . $filters['name'] . "%")
                ->orWhere('name_eng', 'like', "%" . $filters['name'] . "%")
                ->orderBy('id', 'desc')
                ->paginate();
        } elseif (!empty($filters['name'])) {
            $countries = Country::where('name', $filters['name'])
                ->orderBy('id', 'desc')
                ->paginate();
        } elseif (!empty($filters['name_eng'])) {
            $countries = Country::where('name', $filters['name_eng'])
                ->orderBy('id', 'desc')
                ->paginate();
        }
        else {
            $countries = Country::orderBy('id', 'desc')->paginate();
        }
        $countries->load('currency');
        return $countries;
    }

    /**
     * Создание записи
     * @param array $data
     * @return int
     */
    public function createFromArray(array $data)
    {
        return Country::insertOrIgnore($data);
    }

    /**
     * Изменение записи
     * @param int $id
     * @param array $data
     * @return int
     */
    public function updateFromArray($id, array $data)
    {
        return Country::where('id', $id)->update($data);
    }

    /**
     * Удаление записи
     * @param int $id
     * @return mixed
     */
    public function delete($id)
    {
        return Country::where('id', $id)->delete();
    }
}
