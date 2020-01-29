<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MailResetPassword extends ResetPassword
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        parent::__construct($token);
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
//        $link = url( '/reset-password/' . $this->token );
        $link = env('CLIENT_BASE_URL' ) . '/reset-password/' . $this->token;
        return ( new MailMessage )
            ->subject( 'Сброс пароля' )
            ->greeting('Здравствуйте, ' . $notifiable->name . '!')
            ->line( 'Здравствуйте! Вы получили это письмо, потому что мы получили запрос на сброс пароля для вашей учетной записи.' )
            ->line( 'Срок действия ссылки для сброса пароля истекает через 60 минут.' )
            ->line( 'Если вы не запрашивали сброс пароля, никаких дальнейших действий не требуется.' )
            ->action( 'Сбросить пароль', $link )
            ->markdown('mail.auth.reset-password');
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
