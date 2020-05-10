<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackAttachment;
use Illuminate\Notifications\Messages\SlackMessage;
use Notification;
use Illuminate\Queue\Events\JobFailed;

class SlackFailedJob extends Notification
{
    use Queueable;

    /**
     * @var JobFailed
     */
    public $event;

    /**
     * Create a new notification instance.
     *
     * @param JobFailed $event
     */
    public function __construct(JobFailed $event)
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
            ->content('A job failed at '.config('app.name'))
            ->attachment(function (SlackAttachment $attachment) use ($notifiable) {
                $attachment->fields([
                    'Exception message' => $notifiable->event->exception->getMessage(),
                    'Job class' => $notifiable->event->job->resolveName(),
                    'Job body' => $notifiable->event->job->getRawBody(),
                    'Exception' => $notifiable->event->exception->getTraceAsString(),
                ]);
            });
    }
}
