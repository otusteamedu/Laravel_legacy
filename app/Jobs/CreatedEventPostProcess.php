<?php

namespace App\Jobs;

use App\Mail\EventCreated;
use App\Models\Event;
use App\Notifications\SlackFailedJob;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreatedEventPostProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function handle()
    {
        \Mail::send((new EventCreated($this->event)));

        return true;
    }

    // @ToDo: сюда приходит только объект Exception, но не JobFailed
    public function failed(\Exception $exception)
    {
        \Log::channel(['slack'])->error('Job failed. ' . self::class, ['exception' => $exception]);
        /* @ToDo: do it.
        $slackFailedJob = new SlackFailedJob(JobFailed $jobFailed);
        $slackFailedJob->toSlack();*/
    }
}
