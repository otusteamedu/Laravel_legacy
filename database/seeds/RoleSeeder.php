<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(array(
            array('id' => '1','name' => 'Администратор'),
            array('id' => '2','name' => 'Пользователь'),
            array('id' => '3','name' => 'Казначей'),
        ));
    }
}
