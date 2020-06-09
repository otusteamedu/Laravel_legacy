<?php


namespace App\Services\Filters\Listeners;

use App\Services\Filters\Notifications\FilterCreatedNotification;
use App\Services\Filters\Events\FilterCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use \Log;
use Notification;

class FilterCreatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(FilterCreated $event)
    {
        echo $event->email . ' LISTENER ' . PHP_EOL;
        Log::info(self::class, [
            'id' => 1,
            'Filter' => 'created'
        ]);

        Notification::route('slack', env('LOG_SLACK_WEBHOOK_URL'))
            ->notify(new FilterCreatedNotification());
    }
}
