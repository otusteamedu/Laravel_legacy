<?php

use Illuminate\Database\Seeder;

class FormatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('seeds.formats') as $format) {
            DB::table('formats')->insert($format);
        }
    }
}
