<?php


namespace App\Services\Interfaces;


use App\Base\Service\IBaseService;
use Carbon\Carbon;

interface IGenreService extends IBaseService
{
    public function availableGenres(Carbon $date_from, Carbon $date_to = null): array;
}
