<?php


namespace App\Repositories\Interfaces;


use App\Base\Repository\IBaseRepository;
use App\Models\MovieShowing;
use App\Models\Place;
use App\Models\Tariff;
use Illuminate\Database\Eloquent\Collection;

interface IShowingPriceRepository extends IBaseRepository {
    public function getPrice(MovieShowing $movieShowing, Place $place): int;
    public function getShowingPrices(MovieShowing $movieShowing): Collection;
    public function getPriceByTariff(MovieShowing $movieShowing, Tariff $tariff): int;
}
