<?php
//php artisan migrate:refresh --seed


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(ReasonSeeder::class);
        $this->call(StudentSeeder::class);

        $this->call(RoleUserSeeder::class);
        $this->call(StudentUserSeeder::class);

        $this->call(TransactionSeeder::class);

    }
}
