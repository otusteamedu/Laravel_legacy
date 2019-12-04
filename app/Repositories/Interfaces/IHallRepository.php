<?php


namespace App\Repositories\Interfaces;

use App\Base\Repository\IBaseRepository;
use App\Models\Cinema;
use App\Models\Hall;
use Illuminate\Database\Eloquent\Collection;

interface IHallRepository extends IBaseRepository
{
    public function getHalls(Cinema $cinema): Collection;
    public function hallInCinema(Hall $hall, Cinema $cinema): bool;
}

