<?php

use App\Models\User;
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
        User::create([
            'username' => 'buk2018irinam',
            'email' => 'buk2018irinam@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('test123'),
            'remember_token' => Str::random(10),
            'role_id' => 1,
            'description' => 'Test admin',
            'icon' => 'https://ya.ru'
        ]);
        factory(User::class, 50)->create();
    }
}
