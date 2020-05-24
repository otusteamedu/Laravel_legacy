<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();

        $r = new Role();
        $r->name = 'admin';
        $r->name_ru = 'администратор';
        $r->save();

        $r = new Role();
        $r->name = 'user';
        $r->name_ru = 'пользователь';
        $r->save();
    }
}
