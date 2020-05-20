<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $email = Str::random(10).'@gmail.com';
        $password = Str::random();
        DB::table('users')->insert([
            'group_id' => 1,
            'name' => 'admin',
            'email' => $email,
            'password' => Hash::make($password),
            'balance' => 0
        ]);

        echo "Admin Email: {$email}\nAdmin password: {$password}\n";
    }
}
