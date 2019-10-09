<?php

use App\Models\Handbook;
use Illuminate\Database\Seeder;

class HandbookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Handbook::class, 2)->create();
    }
}
