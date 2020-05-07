<?php

namespace App\Jobs;

use App\Mail\AuthorNotificationOfTheEventCreated;
use App\Mail\NearbyUsersNotificationOfTheEventCreated;
use App\Models\Event;
use App\Notifications\SlackFailedJob;
use App\Services\NeighborUsersOfEvent\NeighborUsersOfEventService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreatedEventPostProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $event;
    private $neighborUsersOfEventService;

    public function __construct(Event $event)
    {
        $this->event = $event;
        $this->neighborUsersOfEventService = resolve(NeighborUsersOfEventService::class);
    }

    public function handle()
    {
        \Mail::send((new AuthorNotificationOfTheEventCreated($this->event)));

        $neighborUsers = $this->neighborUsersOfEventService->getNeighborUsersByEvent($this->event);

        foreach ($neighborUsers as $user) {
            \Mail::send((new NearbyUsersNotificationOfTheEventCreated($this->event, $user)));
        }

        return true;
    }

    // @ToDo: сюда приходит только объект Exception, но не JobFailed
    public function failed(\Exception $exception)
    {
        \Log::channel(['slack'])->error('Job failed. ' . self::class, ['exception' => $exception]);
        /* @ToDo: do it.
         * $slackFailedJob = new SlackFailedJob(JobFailed $jobFailed);
         * $slackFailedJob->toSlack();*/
    }
}
