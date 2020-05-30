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

        if (config('app.env') == 'production') {
            return;
        }

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
        $this->call(ProductTranslationSeeder::class);
        $this->call(OrderStatusTranslationSeeder::class);
        $this->call(ColorTranslationSeeder::class);
        $this->call(MaterialTranslationSeeder::class);
        $this->call(GuaranteeTranslationSeeder::class);
        $this->call(RoleTranslationSeeder::class);
        $this->call(CategoryGroupTranslationSeeder::class);
        $this->call(CategoryTranslationSeeder::class);
    }
}
