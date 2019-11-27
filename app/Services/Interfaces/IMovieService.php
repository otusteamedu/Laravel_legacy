<?php


namespace App\Services\Interfaces;

use App\Base\Service\CD;
use App\Base\Service\IBaseService;

interface IMovieService extends IBaseService
{
    public function getSoonInRental(int $nLastCount): array;

    public function getInRentalRand(int $nCount): array;
}
