<?php
/**
 * Description of CitiesService.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Cities;


use App\Models\City;
use App\Services\Cities\Handlers\CreateCityHandler;

class CitiesService
{

    private $createCityHandler;
    
    public function __construct(
        CreateCityHandler $createCityHandler
    )
    {
        $this->createCityHandler = $createCityHandler;
    }

    /**
     * @param array $data
     * @return City
     */
    public function createCity(array $data): City
    {
        return $this->createCityHandler->handle($data);
    }

}