<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        factory(User::class, rand(10, 30))->create();

        $admin = new User();
        $admin->name = 'admin';
        $admin->email = 'admin@mail.com';
        $admin->password = bcrypt('admin');
        $admin->address = 'admins home';
        $admin->save();
    }
}
