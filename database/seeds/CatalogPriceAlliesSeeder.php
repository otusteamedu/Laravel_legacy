<?php

use App\Models\Catalog\Item;
use App\Models\Catalog\Price;
use Illuminate\Database\Seeder;

class CatalogPriceAlliesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = Item::all();
        $priceLanguage = Price::all();
        
        foreach($items AS $item){
            $item->price()->attach(
                $priceLanguage->random(3)->pluck('id')->toArray(),
                ['price'=>rand(100, 1000)]
            );
        }
    }
}
