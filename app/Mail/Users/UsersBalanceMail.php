<?php

namespace App\Mail\Users;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class UsersBalanceMail
 * Письмо о состояние баланса пользователя
 *
 * @package App\Mail\Users
 */
class UsersBalanceMail extends Mailable
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
        $this->subject = __('emails/users.balance.title');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.users.balance');
    }
}
