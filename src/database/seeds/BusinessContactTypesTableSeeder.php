<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessContactTypesTableSeeder extends Seeder
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
                'name' => "Телефон",
                'description' => '',
            ],
            [
                'name' => "WhatsApp",
                'description' => '',
            ],
            [
                'name' => "Email",
                'description' => '',
            ],
            [
                'name' => "Skype",
                'description' => '',
            ],
        ];

        foreach ($types as $type) {
            DB::insert('insert into business_contact_types (name, description) values (:name, :description)', [
                ':name' => $type['name'],
                ':description' => $type['description'],
            ]);
        }
    }
}
