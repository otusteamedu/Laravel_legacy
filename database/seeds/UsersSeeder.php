<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\User::class, 1)->create([
            'name' => 'Vyacheslav',
            'email' => 'webdev2030@gmail.com',
            'password' => Hash::make('19582')
        ]); // Root admin
    }
}
