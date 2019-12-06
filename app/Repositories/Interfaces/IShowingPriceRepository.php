<?php


namespace App\Repositories\Interfaces;


use App\Base\Repository\IBaseRepository;
use App\Models\MovieShowing;
use App\Models\Place;

interface IShowingPriceRepository extends IBaseRepository {
    public function getPrice(MovieShowing $movieShowing, Place $place): int;
}
