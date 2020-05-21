<?php

use Illuminate\Database\Seeder;
use App\Models\Message;
use App\Models\Division;
use App\Models\Advert;
use Illuminate\Support\Facades\DB;

class AdvertsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     *
     */
    public function run()
    {
        //DB::table('adverts')->truncate();

        foreach (Division::all() as $division) {
            factory(Advert::class, 10)
                ->create(['division_id' => $division->id])
                ->each(function ($advert){
                    $advert->messages()
                        ->saveMany(factory(Message::class, 2)
                            ->make(['advert_id'=>$advert->id])
                        );
                });
        }
    }
}




