<?php


namespace App\Services\Interfaces;


use App\Base\Service\IBaseService;
use App\Models\MovieShowing;
use App\Models\Place;
use App\Models\Tariff;

interface IShowingPriceService extends IBaseService
{
    public function getPrice(MovieShowing $movieShowing, Place $place): int;
    public function getShowingPrices(MovieShowing $movieShowing): array;
    public function getPriceByTariff(MovieShowing $movieShowing, Tariff $tariff): int;
}
