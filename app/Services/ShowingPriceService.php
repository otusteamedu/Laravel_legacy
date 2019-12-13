<?php


namespace App\Services;


use App\Base\Service\BaseService;
use App\Models\MovieShowing;
use App\Models\Place;
use App\Models\Tariff;
use App\Repositories\Interfaces\IShowingPriceRepository;
use App\Services\Interfaces\IShowingPriceService;

class ShowingPriceService extends BaseService implements IShowingPriceService
{
    public function getPrice(MovieShowing $movieShowing , Place $place): int
    {
        /** @var IShowingPriceRepository $repository */
        $repository = $this->getRepository();
        return $repository->getPrice($movieShowing , $place);
    }

    public function getShowingPrices(MovieShowing $movieShowing): array
    {
        /** @var IShowingPriceRepository $repository */
        $repository = $this->getRepository();
        return $repository->getShowingPrices($movieShowing)->toArray();
    }

    public function getPriceByTariff(MovieShowing $movieShowing , Tariff $tariff): int
    {
        /** @var IShowingPriceRepository $repository */
        $repository = $this->getRepository();
        return $repository->getPriceByTariff($movieShowing, $tariff);
    }
}
