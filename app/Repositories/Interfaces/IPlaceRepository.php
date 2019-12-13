<?php


namespace App\Repositories\Interfaces;


use App\Base\Repository\IBaseRepository;
use App\Models\Hall;
use Illuminate\Database\Eloquent\Collection;

interface IPlaceRepository extends IBaseRepository
{
    public function getPlacesInHall(Hall $hall): Collection;
}
