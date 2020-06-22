<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ["Салон красоты", "Парикмахерская", "Барбершоп"];

        foreach ($types as $type) {
            factory(\App\Models\BusinessType::class, 1)->create([
                'name' => $type
            ]);
        }
    }
}
