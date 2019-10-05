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
        $this->createAdmin();
        factory(\App\Models\User::class, 10)->create();
    }

    private function createAdmin()
    {
        $adminEmail = 'egor@otus.ru';
        if (!\App\Models\User::where('email', $adminEmail)->count()) {
            factory(\App\Models\User::class)->create([
                'level' => \App\Models\User::LEVEL_ADMIN,
                'email' => $adminEmail,
                'password' => Hash::make($adminEmail),
            ]);
        }
    }
}
