<?php

use Illuminate\Database\Seeder;

class FinanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Finance::class, 50)->create();
    }
}
