<?php


namespace App\Services\Interfaces;


use App\Base\Service\IBaseService;
use App\Models\Hall;

interface IPlaceService extends IBaseService
{
    public function getPlacesInHall(Hall $hall): array;
}
