<?php
/**
 * Description of CountryRepository.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Countries\Repositories;


use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;

class EloquentCountryRepository implements CountryRepositoryInterface
{

    public function find(int $id)
    {
        return Country::find($id);
    }

    /**
     * @param array $filters
     * @param array $with
     * @param int|null $limit
     * @param int|null $offset
     * @return Collection
     */
    public function getBy(array $filters = [], array $with = [], ?int $limit = null, ?int $offset = null): Collection
    {
        $country = Country::query();
        if ($limit) {
            $country->take($limit);
        }
        if ($offset) {
            $country->skip($offset);
        }
        $country->with($with);
        return $country->get([
            'countries.*'
        ]);
    }

    /**
     * @param array $filters
     * @param array $with
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|Collection
     */
    public function search(array $filters = [], array $with = [])
    {
        return Country::with($with)->paginate();
    }

    public function createFromArray(array $data): Country
    {
        $country = new Country();
        return $country->create($data);
    }

    public function updateFromArray(Country $country, array $data)
    {
        $country->update($data);
        return $country;
    }

}
