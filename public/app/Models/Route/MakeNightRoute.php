<?php

namespace App\Models\Route;

use App\Models\Region;
use App\Models\Transport\Transport;

/**
 * Class MakeNightRoute
 * @package App\Models\Route
 */

class MakeNightRoute extends MakeRoute
{
    /**
     * @param Region $region
     * @param Transport $transport
     * @param $interval
     * @param $date
     * @return array
     */

    public function createRoute(Region $region, Transport $transport, $interval, $date)
    {
        $nightRoute = new NightRoute($region, $transport, $date);

        return $nightRoute->create($interval);
    }
}
