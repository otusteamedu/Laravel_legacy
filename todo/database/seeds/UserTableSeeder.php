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
            'id' => 1,
            'name' => 'admin',
            'email' => 'admin@mail.ru',
            'password' => bcrypt('secret'),
            'api_token' => Str::random(60),

        ];

        for ($i = 2; $i <= 7; $i++) {
            $data [] = [
                'id' => $i,
                'name' => 'Пользователь ' . $i,
                'email' => 'user' . $i . '@testmailg.ru',
                'password' => bcrypt('test'),
                'api_token' => Str::random(60),
            ];
        }


        DB::table('users')->insert($data);

        //role
        unset($data);
        $data [] = [
            'id' => '1',
            'name' => 'Админ',


        ];
        $data [] = [
            'id' => '2',
            'name' => 'Users',

        ];
        DB::table('roles')->insert($data);


        //user_role
        unset($data);

        $data [] = [
            'user_id' => '1',
            'role_id' => 1


        ];

        for ($i = 2; $i <= 7; $i++) {
            $data [] = [
                'user_id' => $i,
                'role_id' => 2
            ];
        }


        DB::table('user_role')->insert($data);


        //permissions
        unset($data);
        $data [] = [
            'id' => '1',
            'name' => 'Полный доступ',
            'route' => 'admin.index'

        ];
        $data [] = [
            'id' => '2',
            'name' => 'Управление задачами пользователя',
            'route' => 'admin.tasks.index'

        ];
        $data [] = [
            'id' => '3',
            'name' => 'Пользователи',
            'route' => 'admin.users.index'

        ];
        $data [] = [
            'id' => '4',
            'name' => 'Привилегии',
            'route' => 'admin.permissions.index'

        ];
        $data [] = [
            'id' => '5',
            'name' => 'Роли',
            'route' => 'admin.roles.index'

        ];
        DB::table('permissions')->insert($data);


        //role_permissions
        unset($data);
        $data [] = [
            'id' => '1',
            'role_id' => 1,
            'permission_id' => 1,

        ];
        DB::table('role_permissions')->insert($data);
    }
}
