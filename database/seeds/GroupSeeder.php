<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            'name' => 'Администратор'
        ]);
        DB::table('groups')->insert([
            'name' => 'Менеджер'
        ]);
        DB::table('groups')->insert([
            'name' => 'Разработчик'
        ]);
        DB::table('groups')->insert([
            'name' => 'Клиент'
        ]);
    }
}
