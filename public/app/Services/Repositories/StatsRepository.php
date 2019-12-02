<?php


namespace App\Services\Repositories;

use App\Models\Clients\Client;
use App\Models\Region;
use App\Models\Stats\Stat;

class StatsRepository
{
    public function getRegions()
    {
        return Stat::paginate(50);
    }

    public function updateRegions()
    {
        $regions = Region::select('id')->get();

        foreach ($regions as $region)
        {
            $clientCount = Client::where('region_id', '=', $region['id'])->count();

            Stat::where('region_id', $region['id'])->update(['amount' => $clientCount]);
        }
    }

}

