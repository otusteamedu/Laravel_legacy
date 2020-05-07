<?php

namespace App\Notifications;

use BeyondCode\SlackNotificationChannel\Messages\SlackAttachment;
use BeyondCode\SlackNotificationChannel\Messages\SlackMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\Events\JobFailed;

class SlackFailedJob extends Notification
{
    use Queueable;

    /**
     * @var JobFailed
     */
    private $event;

    /**
     * Create a new notification instance.
     *
     * @param JobFailed $jobFailed
     */
    public function __construct(JobFailed $jobFailed)
    {
        $this->event = $jobFailed;
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

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->content('A job failed at ' . config('app.name'))
            ->attachment(function (SlackAttachment $attachment) use ($notifiable) {
                $attachment->fields([
                    'Exception message' => $this->event->exception->getMessage(),
                    'Job class' => $this->event->job->resolveName(),
                    'Job body' => $this->event->job->getRawBody(),
                    'Exception' => $this->event->exception->getTraceAsString(),
                ]);
            });
    }
}
