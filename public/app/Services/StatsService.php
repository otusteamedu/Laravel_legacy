<?php


namespace App\Services;

use App\Models\Stats\Stat;
use App\Models\Region;
use App\Models\Clients\Client;

class StatsService
{
    public function regionStats()
    {
        return Stat::paginate(50);
    }

    public function update()
    {
        $regions = Region::select('id')->get();

        foreach ($regions as $region)
        {
            $clientCount = Client::where('region_id', '=', $region['id'])->count();

            Stat::where('region_id', $region['id'])->update(['amount' => $clientCount]);
        }
    }


}
