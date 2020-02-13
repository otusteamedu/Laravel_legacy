<?php

use Illuminate\Database\Seeder;

class OrgTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('org_types')->insert(
            array(
                array('id' => '1','name' => 'Корпоративный','name_eng' => 'Corporate','created_at' => '2020-02-12 23:20:15'),
                array('id' => '2','name' => 'Муниципальный','name_eng' => 'Municipal','created_at' => '2020-02-12 23:20:15'),
                array('id' => '3','name' => 'Государственный','name_eng' => 'Sovereign','created_at' => '2020-02-12 23:20:15')
            )
        );
    }
}
