<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class UserRemindPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $new_password;

	/**
	 * Create a new message instance.
	 *
	 * @param User $user
	 * @param string $newPass
	 */
	public function __construct(User $user, $newPass = '')
    {
        $this->user = $user;
        $this->new_password = $newPass;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.user.remind_password');
    }
}
