<?php


namespace App\Repositories;


use App\Base\Repository\BaseRepository;
use App\Models\Cinema;
use App\Models\Hall;
use App\Repositories\Interfaces\IHallRepository;
use Illuminate\Database\Eloquent\Collection;

class HallRepository extends BaseRepository implements IHallRepository
{
    public function getHalls(Cinema $cinema): Collection {
        return $cinema->halls;
    }

    public function hallInCinema(Hall $hall , Cinema $cinema): bool {
        return $hall->cinema->is($cinema);
    }
}
