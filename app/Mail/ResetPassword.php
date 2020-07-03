<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /** @var string */
    protected $token;

    protected $notifiable;

    /**
     * Create a new message instance.
     *
     * @param string $token
     * @param $notifiable
     */
    public function __construct(string $token, $notifiable)
    {
        $this->token = $token;
        $this->notifiable = $notifiable;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.reset_password_notification', [
            'url' => url(config('app.url').route('password.reset', $this->token, false)),
            'name' => $this->notifiable->name,
        ]);
    }
}
