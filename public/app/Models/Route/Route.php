<?php

namespace App\Models\Route;

use App\Models\Transport\Transport;
use App\Models\Region;
use App\Models\DateHelper;

/**
 * Class Route
 * @package App\Models\Route
 */

class Route
{
    private $region;
    private $transport;
    private $date;

    /**
     * Route constructor.
     * @param Region $region
     * @param Transport $transport
     * @param $date
     */

    public function __construct(Region $region, Transport $transport, $date)
    {
        $this->region = $region;
        $this->transport = $transport;
        $this->date = $date;
    }

    /**
     * @return array
     */

    public function allRoutes()
    {
        $newRoute = $this->getRoutes();
        $reverseRoad = $this->getRoutes(true);

        return array_merge($newRoute, $reverseRoad);
    }

    /**
     * @param bool $reverse
     * @return array
     */

    public function getRoutes($reverse = false)
    {
        if ($reverse) {
            $this->date = DateHelper::shiftTime($this->region->distance, $this->date);
            $this->region = Region::find(0);
        }

        $routes = [];
        $hours = DateHelper::getHours($this->date);

        /**
         * Реализация паттерна Фабричный метод
         * Классы MakeSimpleRoute, MakeNightRoute создают
         * разные типы объектов RouteInterface
         */

        if ($this->region->distance > (24 - $hours)) {
            $todayDistance = 24 - $hours;
            $routes[] = (new MakeSimpleRoute())
                ->create($this->region, $this->transport, $todayDistance, $this->date);
            $routes[] = (new MakeNightRoute())
                ->create($this->region, $this->transport, $this->region->distance, $this->date);
        } else {
            $routes[] = (new MakeSimpleRoute())
                ->create($this->region, $this->transport, $this->region->distance, $this->date);
        }

        return $routes;
    }
}
