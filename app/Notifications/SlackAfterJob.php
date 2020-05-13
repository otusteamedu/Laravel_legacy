<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackAttachment;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\Events\JobProcessed;

class SlackAfterJob extends Notification
{
    use Queueable;

    /**
     * @var JobProcessed
     */
    public $event;

    /**
     * Create a new notification instance.
     *
     * @param JobProcessed $event
     */
    public function __construct(JobProcessed $event)
    {
        $this->event = $event;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    public function toSlack($notifiable)
    {

        return (new SlackMessage)
            ->content('A job true at '.config('app.name'))
            ->attachment(function (SlackAttachment $attachment){
                $attachment->title('Image resize');
            });
    }
}
