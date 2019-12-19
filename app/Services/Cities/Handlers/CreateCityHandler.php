<?php
/**
 * Description of CreateCityHandler.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Cities\Handlers;


use App\Models\City;
use App\Services\Cities\Repositories\EloquentCityRepository;

class CreateCityHandler
{

    private $cityRepository;

    public function __construct(
        EloquentCityRepository $cityRepository
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
        return $this->cityRepository->createFromArray($data);
    }

}