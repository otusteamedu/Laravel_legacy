<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MailEmailVerification extends Notification
{
    use Queueable;

//    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
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
        $link = url('/user/verify/' . $notifiable->verifyUser->token);
        return ( new MailMessage )
            ->subject( 'Подтверждение адреса электронной почты' )
            ->greeting('Добро пожаловать, ' . $notifiable->name . '!')
            ->line( 'Пожалуйста, нажмите на ссылку ниже, чтобы подтвердить свой адрес электронной почты.' )
            ->line( 'Если вы не регистрировались на нашем сайте, никаких дальнейших действий не требуется.' )
            ->action( 'Подтвердить Email', $link )
            ->markdown('mail.auth.email-verification');
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
