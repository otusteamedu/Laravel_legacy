<?php

use App\Model\User\User;
use App\Model\User\UserStatistic;
use Illuminate\Database\Seeder;

/**
 * Class UserStatisticSeeder
 *
 * Заполняет таблицу статистики пользователей
 */
class UserStatisticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (User::all() as $user) {
            factory(UserStatistic::class)->create(['user_id' => $user->id]);
        }
    }
}
