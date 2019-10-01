<?php

use App\Models\SelectionMaterial;
use Illuminate\Database\Seeder;

class SelectionMaterialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(SelectionMaterial::class, 4)->create();
    }
}
