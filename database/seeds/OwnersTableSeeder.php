<?php

use Illuminate\Database\Seeder;

class OwnersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('seeds.owners') as $format) {
            DB::table('owners')->insert($format);
        }
    }
}
