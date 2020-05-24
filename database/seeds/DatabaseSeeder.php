<?php

use App\Models\Guarantee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call(OrderStatusSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(ColorSeeder::class);
        $this->call(MaterialSeeder::class);
        $this->call(GuaranteeSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(OrderProductSeeder::class);
        $this->call(UserRoleSeeder::class);
        $this->call(CategoryGroupSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(CategoryProductSeeder::class);
    }
}
