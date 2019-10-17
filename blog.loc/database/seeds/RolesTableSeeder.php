<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')
            ->insert([
                'role' => 'Admin',
                'description' => 'Главная роль',
            ]);
        DB::table('roles')
            ->insert([
                'role' => 'Editor',
                'description' => 'Редактор',
            ]);
        DB::table('roles')
            ->insert([
                'role' => 'User',
                'description' => 'Обычный пользователь',
            ]);
    }
}
