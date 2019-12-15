<?php

use Illuminate\Database\Seeder;

class WishlistProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\WishlistProduct::class, 1000)->create();
    }
}
