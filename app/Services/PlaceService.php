<?php


namespace App\Services;


use App\Base\Service\BaseService;
use App\Models\Hall;
use App\Models\Place;
use App\Repositories\Interfaces\IPlaceRepository;
use App\Services\Interfaces\IPlaceService;

class PlaceService extends BaseService implements IPlaceService
{
    public function getPlacesInHall(Hall $hall): array {
        /** @var IPlaceRepository $repository */
        $result = [];
        $repository = $this->getRepository();
        $repository->getPlacesInHall($hall)->map(
            function($place) use (&$result) {
                /** @var Place $place */
                $item = $place->toArray();
                $item['tariff'] = $place->tariff ? $place->tariff->toArray() : null;

                $result[] = $item;
            }
        );

        return $result;
    }
}
