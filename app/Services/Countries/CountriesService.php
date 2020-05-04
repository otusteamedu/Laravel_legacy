<?php

namespace App\Services\Countries;

use App\Models\Country;
use App\Services\Countries\Repositories\CountryRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CountriesService
{
    private $countryRepository;

    public function __construct(
        CountryRepositoryInterface $countryRepository
    ) {
        $this->countryRepository = $countryRepository;
    }

    /**
     * @param int $id
     * @return Country|null
     */
    public function findCountry(int $id)
    {
        return $this->countryRepository->find($id);
    }

    /**
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function searchCountries(array $filters): LengthAwarePaginator
    {
        return $this->countryRepository->search($filters);
    }
}
