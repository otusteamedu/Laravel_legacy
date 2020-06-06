<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        DB::table('users')->insert([
            'name' => 'JonDow',
            'role'=>'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123'),
        ]);

        DB::table('users')->insert([
            'name' => 'user',
            'role'=>'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('123'),
        ]);

        factory(User::class, 3)->create();


    }
}
