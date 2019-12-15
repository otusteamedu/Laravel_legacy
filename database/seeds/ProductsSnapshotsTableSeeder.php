<?php

use Illuminate\Database\Seeder;

class ProductsSnapshotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\ProductsSnapshot::class, 1000)->create();
    }
}
