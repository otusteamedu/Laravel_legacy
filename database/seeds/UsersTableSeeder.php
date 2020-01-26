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
            'name' => 'Админ тест',
            'email' => 'admin@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('test123'),
            'remember_token' => Str::random(10),
            'role_id' => 3,
            'description' => 'Test admin',
            'icon' => 'https://ya.ru'
        ]);
        User::create([
            'name' => 'Топ менеджер тест',
            'email' => 'top-manager@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('test123'),
            'remember_token' => Str::random(10),
            'role_id' => 4,
            'description' => 'Test manager',
            'icon' => 'https://ya.ru'
        ]);
        User::create([
            'name' => 'Менеджер тест',
            'email' => 'manager@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('test123'),
            'remember_token' => Str::random(10),
            'role_id' => 5,
            'description' => 'Test admin',
            'icon' => 'https://ya.ru'
        ]);
        User::create([
            'name' => 'Частный предприниматель тест',
            'email' => 'private-entrepreneur@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('test123'),
            'remember_token' => Str::random(10),
            'role_id' => 1,
            'description' => 'Test manager',
            'icon' => 'https://ya.ru'
        ]);
        User::create([
            'name' => 'Оптовик тест',
            'email' => 'wholesaler@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('test123'),
            'remember_token' => Str::random(10),
            'role_id' => 2,
            'description' => 'Test manager',
            'icon' => 'https://ya.ru'
        ]);
        factory(User::class, 50)->create();
    }
}
