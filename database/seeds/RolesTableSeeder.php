<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data[0] = [
            'title' => 'Администратор'
        ];
        $data[1] = [
            'title' => 'Менеджер'
        ];

        \DB::table('roles')->insert($data);
    }
}
