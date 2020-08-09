<?php

namespace App\Console\Schedule\Users;

use Illuminate\Console\Scheduling\Schedule;

/**
 * Class Balance
 *
 * Задача отправкки уведомления о балансе
 *
 * @package App\Console\Schedule\Users
 */
class Balance
{

    /**
     * @param Schedule $schedule
     */
    public static function register(Schedule $schedule)
    {
        $schedule->command('users:balance -D')
            ->weeklyOn(1, '9:00')
            ->environments(['test', 'production'])
            ->onOneServer()
            ->runInBackground();
    }

}
