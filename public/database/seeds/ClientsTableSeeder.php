<?php

use Illuminate\Database\Seeder;
use App\Models\Region;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Region::all() as $region) {
            factory(\App\Models\Clients\Client::class, 2)->create(['region_id' => $region->id]);
        }
    }
}
