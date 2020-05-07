<?php

namespace App\Services\Users\Listeners;

use App\Jobs\Queue;
use App\Jobs\RegisteredUserPostProcess;
use App\Services\Users\Events\UserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegisteredListener implements ShouldQueue
{
    public function handle(UserRegistered $event)
    {
        RegisteredUserPostProcess::dispatch($event->getUser())->onQueue(Queue::LOW_PRIORITY);
    }

    public function __get($name)
    {
        if ($name === 'queue') {
            return Queue::LOW_PRIORITY;
        }
    }
}
