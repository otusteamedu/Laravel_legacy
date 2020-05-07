<?php

namespace App\Services\Events\Listeners;

use App\Jobs\Queue;
use App\Jobs\CreatedEventPostProcess;
use App\Services\Events\Events\EventCreated;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventCreatedListener implements ShouldQueue
{
    public function handle(EventCreated $eventCreated)
    {
        CreatedEventPostProcess::dispatch($eventCreated->getEvent())->onQueue(Queue::LOW_PRIORITY);
    }

    public function __get($name)
    {
        if ($name === 'queue') {
            return Queue::LOW_PRIORITY;
        }
    }
}
