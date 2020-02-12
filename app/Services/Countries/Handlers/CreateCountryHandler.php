<?php

namespace App\Services\Countries\Handlers;


use App\Models\Country;
use App\Services\Countries\Repositories\CountryRepositoryInterface;
use Carbon\Carbon;

/**
 * Class CreateCountryHandler
 * @package App\Services\Countries\Handlers
 */
class CreateCountryHandler
{

    /**
     * @var CountryRepositoryInterface
     */
    private $countryRepository;

    public function __construct(
        CountryRepositoryInterface $countryRepository
    )
    {
        $this->countryRepository = $countryRepository;
    }


    /**
     * @param array $data
     * @return Country
     */
    public function handle(array $data): Country
    {
        $data['name'] = ucfirst($data['name']);

        return $this->countryRepository->createFromArray($data);
    }

}