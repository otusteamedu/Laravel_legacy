<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\RoleTranslation;

class RoleTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_translations')->truncate();

        $r = new RoleTranslation();
        $r->role_id = 1;
        $r->locale = 'ru';
        $r->attribute = 'name';
        $r->value = 'администратор';
        $r->save();

        $r = new RoleTranslation();
        $r->role_id = 2;
        $r->locale = 'ru';
        $r->attribute = 'name';
        $r->value = 'пользователь';
        $r->save();
    }
}