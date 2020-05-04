<?php

namespace App\Services\Countries\Repositories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class EloquentCountryRepository
 * @package App\Services\Countries\Repositories
 */
class EloquentCountryRepository implements CountryRepositoryInterface
{
    public function find(int $countryId)
    {
        $country = Country::find($countryId);

        return $country;
    }

    public function search(array $filters = []): LengthAwarePaginator
    {
        $country = Country::query();
        $this->applyFilters($country, $filters);

        return $country->paginate();
    }

    /**
     * @param Builder $queryBuilder
     * @param array $filters
     */
    private function applyFilters(Builder $queryBuilder, array $filters)
    {
        if (isset($filters['name'])) {
            $queryBuilder->where('name', $filters['name']);
        }

        if (isset($filters['phone_code'])) {
            $queryBuilder->where('phone_code', $filters['phone_code']);
        }
    }
}
