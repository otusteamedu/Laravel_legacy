<?php

use App\Models\Contract;
use App\Models\Price;
use Illuminate\Database\Seeder;

class PricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Contract::all() as $contract) {
            $price = factory(Price::class)->make();
            $price->contract()->associate($contract);
            $price->save();
        }
    }
}
