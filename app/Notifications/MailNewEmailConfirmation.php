<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MailNewEmailConfirmation extends Notification
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
        $link = url('/user/confirm/' . $notifiable->emailConfirmation->token);
        return ( new MailMessage )
            ->subject( 'Подтверждение нового адреса электронной почты - ' . $notifiable->emailConfirmation->email )
            ->greeting('Добро пожаловать, ' . $notifiable->name . '!')
            ->line( 'Пожалуйста, нажмите на ссылку ниже, чтобы подтвердить свой новый адрес электронной почты.' )
            ->line( 'Если вы не регистрировались на нашем сайте или не делали запрос на смену адреса электронной почты никаких дальнейших действий не требуется.' )
            ->action( 'Подтвердить новый Email - ' . $notifiable->emailConfirmation->email, $link )
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
