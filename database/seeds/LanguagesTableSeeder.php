<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            'name' => 'english',
            'code' => 'eng',
        ]);
        DB::table('languages')->insert([
            'name' => 'русский',
            'code' => 'rus',
            'country_id' => DB::table('countries')
                ->where('phone_code', '+7')
                ->value('id')
        ]);
        DB::table('languages')->insert([
            'name' => 'українська',
            'code' => 'ukr',
            'country_id' => DB::table('countries')
                ->where('phone_code', '+38')
                ->value('id')
        ]);
        DB::table('languages')->insert([
            'name' => '中文',
            'code' => 'zho',
        ]);
    }
}
