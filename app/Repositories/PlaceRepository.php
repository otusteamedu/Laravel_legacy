<?php


namespace App\Repositories;


use App\Base\Repository\BaseRepository;
use App\Models\Hall;
use App\Models\Place;
use App\Repositories\Interfaces\IPlaceRepository;
use Illuminate\Database\Eloquent\Collection;

class PlaceRepository extends BaseRepository implements IPlaceRepository
{
    /**
     * @param Hall $hall
     * @return Collection
     * @throws \App\Base\WrongNamespaceException
     */
    public function getPlacesInHall(Hall $hall): Collection
    {
        /** @var Place $model */
        $model = $this->getModel();
        return $model->newQuery()->select(['places.*'])
            ->join('halls', 'halls.id', '=', 'places.hall_id')
            ->where('halls.id', $hall->id)->get();
    }
}
