<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // импортируй свой класс, где описаны фрукты
        require_once 'Items.php';
        $fruits = Items::getAll();
        

        foreach($fruits as $fruit)
        {            
            factory(App\Models\Item::class)->create([
                'tag'=>$fruit['tag'],
                'name'=>$fruit['name'],
                'available'=>true,
                'picture'=>$fruit['picture'],
                'price_full'=>$fruit['price'],
                'price_minus30'=>$fruit['price']*0.3,
                'price_minus50'=>$fruit['price']*0.5                
            ]);
        }
    }   
}
