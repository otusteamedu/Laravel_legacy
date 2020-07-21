<?php

namespace App\Mail\Clients;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class ClientInviteMail
 * Письмо о состояние баланса пользователя
 *
 * @package App\Mail\Users
 */
class InviteMail extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * @var User
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->subject = __('emails/clients.invite.title');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.clients.invite');
    }
}
