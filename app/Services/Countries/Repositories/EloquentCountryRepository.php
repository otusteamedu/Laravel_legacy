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
        return Country::find($id);
    }

    /**
     * Поиск и выдача резултата по таблице стран
     * @param string $name фильтр по наименованию страны
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchByNames(string $name = '')
    {
        if ($name) {
            $countries = Country::where('name', 'like', "%" . $name . "%")
                ->orWhere('name_eng', 'like', "%" . $name . "%")
                ->orderBy('id', 'desc')
                ->paginate();
        } else {
            $countries = Country::orderBy('id', 'desc')->paginate();
        }
        $countries->load('currency');
        return $countries;
    }

    /**
     * Создание записи
     * @param array $data
     * @return Country
     */
    public function createFromArray(array $data)
    {
        $country = new Country();
        $country->create($data);
        return $country;
    }

    /**
     * Изменение записи
     * @param int $id
     * @param array $data
     * @return Country
     */
    public function updateFromArray($id, array $data)
    {
        $country = $this->find($id);
        $country->update($data);
        return $country;
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
