<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    const COUNT = 10;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Company::class, self::COUNT)->create();
    }
}
