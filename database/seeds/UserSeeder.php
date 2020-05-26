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

        $user = new \App\Models\User([
            'group_id' => 1,
            'name' => 'admin',
            'email' => $email,
            'password' => Hash::make($password),
            'balance' => 0
        ]);

        $user->save();

        echo "Admin Email: {$email}\nAdmin password: {$password}\n";

        if (env('APP_DEBUG')) {
            factory(\App\Models\User::class, 5)->create();
        }
    }
}
