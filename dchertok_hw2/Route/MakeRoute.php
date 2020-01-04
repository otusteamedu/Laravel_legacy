<?php

namespace App\Models\Route;

use App\Models\Region;
use App\Models\Transport\Transport;

/**
 * Class MakeRoute
 * @package App\Models\Route
 */

abstract class MakeRoute
{
    abstract public function createRoute(Region $region, Transport $transport, $interval, $date);

    /**
     * @param Region $region
     * @param Transport $transport
     * @param $interval
     * @param $date
     * @return mixed
     */

    public function create(Region $region, Transport $transport, $interval, $date)
    {
        return $this->createRoute($region, $transport, $interval, $date);
    }
}
