<?php

use Illuminate\Database\Seeder;
use \App\Models\Country;

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
            [
                'name' => 'english',
                'code' => 'eng',
            ],
            [
                'name' => 'русский',
                'code' => 'rus',
                'country_id' => Country::where('phone_code', '+7')->value('id')
            ],
            [
                'name' => 'українська',
                'code' => 'ukr',
                'country_id' => Country::where('phone_code', '+38')->value('id')
            ],
            [
                'name' => '中文',
                'code' => 'zho',
            ]
        ]);
    }
}
