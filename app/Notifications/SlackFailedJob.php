<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackAttachment;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\Events\JobFailed;

class SlackFailedJob extends Notification
{
    use Queueable;

    /**
     * @var JobFailed
     */
    private JobFailed $event;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(JobFailed $jobFailed)
    {
        //
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
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the Slack representation of the notification.
     *
     * @param  mixed $notifiable
     * @return SlackMessage
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


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
