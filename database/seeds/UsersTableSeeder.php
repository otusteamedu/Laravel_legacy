<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'user',
                'email' => 'user@g.g',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'level' => \App\Models\User::LEVEL_USER,
                'api_token' => Str::random(60),
            ],
             [
                'name' => 'Moderator',
                'email' => 'moderator@g.g',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'level' => \App\Models\User::LEVEL_MODERATOR,
                 'api_token' => Str::random(60),
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@g.g',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'level' => \App\Models\User::LEVEL_ADMIN,
                'api_token' => Str::random(60),
//                'password' => bcrypt(123123),
            ],
        ];
        \DB::table('users')->insert($data);
    }
}
