<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuaranteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('guarantees')->truncate();

        factory(\App\Models\Guarantee::class, rand(5, 20))->create();
    }
}
