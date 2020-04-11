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
        factory(User::class, 50)->create();
        factory(User::class)->create([
            'name' => 'admin',
            'email' => 'vo_vann@mail.ru',
            'password' => Hash::make('1111'),
            'level' => User::LEVEL_ADMIN,
        ]);
    }
}
