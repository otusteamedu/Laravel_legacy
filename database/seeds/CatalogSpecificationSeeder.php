<?php

use App\Models\Catalog\Specification;
use Illuminate\Database\Seeder;

class CatalogSpecificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(Specification::class, 20)->create();
    }
}
