<?php

namespace App\Console;

use App\Console\Commands\Cache\Warm;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        /** Удаление отозванных и истекших токенов */
        $schedule->command('passport:purge')
            ->hourly()
            ->runInBackground();

        /** Прогрев кэша */
        $schedule->command(Warm::class, ['--all', '--force'])
            ->everyTwoHours()
            ->runInBackground();

        /** Ежедневный сброс кэша */
        $schedule->command('cache:clear')
            ->dailyAt('2:00')
            ->runInBackground();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
