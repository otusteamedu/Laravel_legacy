<?php
/**
 * @copyright Copyright (c) Archvile <info@0x25.ru>
 * @link https://0x25.ru
 */

namespace App\Providers;

use App\Notifications\SlackFailedJob;
use Illuminate\Queue\Events\JobFailed;
use Queue;
use Notification;
use Illuminate\Support\ServiceProvider;

class QueueServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Queue::failing(function (JobFailed $event) {
            Notification::route('slack', config('logging.channels.slack.url'))
                ->notify(new SlackFailedJob($event));
        });
    }
}
