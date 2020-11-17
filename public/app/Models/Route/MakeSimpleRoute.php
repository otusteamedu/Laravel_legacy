<?php

namespace App\Models\Route;

use App\Models\Region;
use App\Models\Transport\Transport;

/**
 * Class MakeSimpleRoute
 * @package App\Models\Route
 */

class MakeSimpleRoute extends MakeRoute
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
        $simpleRoute = new SimpleRoute($region, $transport, $date);

        return $simpleRoute->create($interval);
    }
}
