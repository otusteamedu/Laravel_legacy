<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id'=>1,
                'name'=>'Администратор',
                'type'=>'root'
            ],
            [
                'id'=>2,
                'name'=>'Администратор',
                'type'=>'admin'
            ],
            [
                'id'=>3,
                'name'=>'Пользователь',
                'type'=>'user'
            ]
        ];

		DB::table('roles')->insert($roles);
        factory(User::class, 10)->create();
    }
}
