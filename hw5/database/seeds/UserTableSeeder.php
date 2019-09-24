<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        unset($data);

        $data [] = [
            'name'=>'admin',
            'email'=>'admin@mail.ru',
            'password'=>bcrypt('secret'),
        ];

        for($i = 2; $i<=7; $i++){
            $data [] = [
                'name'=>'Пользователь '.$i,
                'email'=>'user'.$i.'@testmailg.ru',
                'password'=>bcrypt('test'),
            ];
        }


        DB::table('users')->insert($data);

        //role
        unset($data);
        $data [] = [
            'id'=>'1',
            'name'=>'Админ',

        ];
        $data [] = [
            'id'=>'2',
            'name'=>'User',

        ];
        DB::table('roles')->insert($data);

        //permissions
        unset($data);
        $data [] = [
            'id'=>'1',
            'name'=>'Полный доступ',

        ];
        $data [] = [
            'id'=>'2',
            'name'=>'Управление задачами пользователя',

        ];
        DB::table('permissions')->insert($data);


        //user_role
        unset($data);
        $data [] = [
            'id'=>'1',
            'user_id'=>1,
            'role_id'=>1,

        ];

        DB::table('user_role')->insert($data);

        //role_permissions
        unset($data);
        $data [] = [
            'id'=>'1',
            'role_id'=>1,
            'permission_id'=>1,

        ];
        DB::table('role_permissions')->insert($data);
    }
}
