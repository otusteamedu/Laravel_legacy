<?php

use App\Models\ReadMaterial;
use Illuminate\Database\Seeder;

class ReadMaterialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ReadMaterial::class, 2)->create();
    }
}
