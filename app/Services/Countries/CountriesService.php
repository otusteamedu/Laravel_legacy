<?php
/**
 * Description of CountriesService.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Countries;


use App\Models\Country;
use App\Services\Countries\Handlers\CreateCountryHandler;
use App\Services\Countries\Repositories\CachedCountryRepositoryInterface;
use App\Services\Countries\Repositories\CountryRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CountriesService
{

    /** @var CountryRepositoryInterface */
    private $countryRepository;
    /** @var CachedCountryRepositoryInterface */
    private $cachedCountryRepository;
    /** @var CreateCountryHandler */
    private $createCountryHandler;

    public function __construct(
        CreateCountryHandler $createCountryHandler,
        CachedCountryRepositoryInterface $cachedCountryRepository,
        CountryRepositoryInterface $countryRepository
    )
    {
        $this->createCountryHandler = $createCountryHandler;
        $this->cachedCountryRepository = $cachedCountryRepository;
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
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->cachedCountryRepository->getBy();
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchCachedCountriesWithCities(): LengthAwarePaginator
    {
        return $this->cachedCountryRepository->search([], [
            'cities'
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search(): LengthAwarePaginator
    {
        return $this->countryRepository->search([]);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchCountriesWithCities(): LengthAwarePaginator
    {
        return $this->countryRepository->search([], [
            'cities'
        ]);
    }

    /**
     * @param array $data
     * @return Country
     */
    public function storeCountry(array $data): Country
    {
        $country = $this->createCountryHandler->handle($data);

        // do some logic

        return $country;
    }

    /**
     * @param Country $country
     * @param array $data
     * @return Country
     */
    public function updateCountry(Country $country, array $data): Country
    {
        return $this->countryRepository->updateFromArray($country, $data);
    }

}