<?php


namespace App\Notifications;


use Illuminate\Queue\Events\JobFailed;

class SlackFiledJob
{
    private $event;

    /**
     * SlackFiledJob constructor.
     * @param JobFailed $jobFailed
     */
    public function __construct(JobFailed $jobFailed)
    {
        $this->event = $jobFailed;
    }

    public function via($notifiable)
    {
        return ['slack'];
    }

    public function toSlack($notifiable)
    {
        //return (new SlackMessage)->con
    }
}
