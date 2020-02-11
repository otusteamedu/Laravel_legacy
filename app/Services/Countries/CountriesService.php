<?php

namespace App\Services\Countries;


use App\Models\Country;
use App\Services\Countries\Handlers\CreateCountryHandler;
use App\Services\Countries\Repositories\CountryRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class CountriesService
 * @package App\Services\Countries
 */
class CountriesService
{

    /** @var CountryRepositoryInterface */
    private $countryRepository;
    /** @var CreateCountryHandler */
    private $createCountryHandler;

    /**
     * CountriesService constructor.
     * @param CreateCountryHandler $createCountryHandler
     * @param CountryRepositoryInterface $countryRepository
     */
    public function __construct(
        CreateCountryHandler $createCountryHandler,
        CountryRepositoryInterface $countryRepository
    )
    {
        $this->createCountryHandler = $createCountryHandler;
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
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchCountries(): LengthAwarePaginator
    {
        return $this->countryRepository->search();
    }

    /**
     * @param array $data
     * @return Country
     */
    public function storeCountry(array $data): Country
    {
        $country = $this->createCountryHandler->handle($data);

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

    /**
     * @param Country $country
     * @return bool
     */
    public function deleteCountry(Country $country): bool
    {
        return $this->countryRepository->delete($country);
    }

    /**
     * @return array
     */
    public function getListCountries(): array
    {
        $countriesRaw = $this->countryRepository->getListCountries();
        $countries = array_column($countriesRaw, 'name', 'id');
        return $countries;

    }

}