<?php


namespace App\Services\Interfaces;

use App\Base\Service\IBaseService;
use Carbon\Carbon;

interface ICinemaService extends IBaseService
{
    public function availableCinemas(Carbon $date_from, Carbon $date_to = null): array;

    public function cinemaList(): array;
}
