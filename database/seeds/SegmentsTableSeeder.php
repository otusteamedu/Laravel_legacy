<?php

use Illuminate\Database\Seeder;

class SegmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Segment::class, 5)->create();
    }
}
