<?php


namespace App\Services\Countries;

use App\Models\Country;
use App\Services\Countries\Handlers\CreateCountryHandler;
use App\Services\Countries\Repositories\CountryRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CountriesService
{
    /** @var CountryRepositoryInterface */
    private $countryRepository;
    /** @var CreateCountryHandler */
    private $createCountryHandler;

    public function __construct(
        CreateCountryHandler $createCountryHandler,
        CountryRepositoryInterface $countryRepository
    )
    {
        $this->createCountryHandler = $createCountryHandler;
        $this->countryRepository = $countryRepository;
    }

}
