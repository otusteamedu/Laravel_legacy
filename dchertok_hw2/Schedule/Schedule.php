<?php

namespace App\Models\Schedule;

use App\Models\Region;
use App\Models\Route\Route;
use App\Models\Transport\Transport;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Transport\Bus;

/**
 * Class Schedule
 * @package App\Models\Schedule
 */

class Schedule extends Model
{
    private $className;

    /**
     * @param Request $request
     * @param $className
     * @return bool
     */

    protected function store(Request $request, $className)
    {
        $post = $request->all();
        $region = Region::find($post['region_id']);
        $this->className = $className;
        $transport = Bus::find($post['transport_id']);
        $date =  $post['date'] . ' ' . $post['time'];

        $route = new Route($region, $transport, $date);
        $allRoutes = $route->allRoutes();

        foreach ($allRoutes as $route) {
            if(!empty($route)) {
                $this->create($route, $transport);
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * @param $route
     * @param Transport $transport
     */

    private function create($route, Transport $transport)
    {
        $item = new $this->className();
        $item->date = $route[0];
        $item->interval = $route[1];
        $item->region_id = $route[2];
        $item->transport_id = $transport->id;
        $item->save();
    }
}
