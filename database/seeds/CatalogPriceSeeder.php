<?php

use App\Models\Catalog\Price;
use Illuminate\Database\Seeder;

class CatalogPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Price::class, 3)->create();
    }
}
