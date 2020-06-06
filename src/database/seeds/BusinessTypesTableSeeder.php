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
        $types = [
            [
                'name' => "Салон красоты",
                'description' => '',
            ],
            [
                'name' => "Парикмахерская",
                'description' => '',
            ],
            [
                'name' => "Барбершоп",
                'description' => '',
            ],
        ];

        foreach ($types as $type) {
            DB::insert('insert into business_types (name, description) values (:name, :description)', [
                ':name' => $type['name'],
                ':description' => $type['description'],
            ]);
        }
    }
}
