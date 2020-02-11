<?php

namespace App\Services\Cities\Handlers;


use App\Models\City;
use App\Services\Cities\Repositories\CityRepositoryInterface;
use Carbon\Carbon;

/**
 * Class CreateCityHandler
 * @package App\Services\Cities\Handlers
 */
class CreateCityHandler
{

    /**
     * @var CityRepositoryInterface
     */
    private $cityRepository;

    public function __construct(
        CityRepositoryInterface $cityRepository
    )
    {
        $this->cityRepository = $cityRepository;
    }


    /**
     * @param array $data
     * @return City
     */
    public function handle(array $data): City
    {
        $data['name'] = ucfirst($data['name']);

        return $this->cityRepository->createFromArray($data);
    }

}