<?php

namespace App\Mail;

use App\Models\Event;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NearbyUsersNotificationOfTheEventCreated extends Mailable
{
    use Queueable, SerializesModels;

    private $event;
    private $user;

    /**
     * Create a new message instance.
     *
     * @param Event $event
     * @param User $user
     */
    public function __construct(Event $event, User $user)
    {
        $this->event = $event;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.events.nearby_created')
            ->from(config('mail.from.address'))
            ->to($this->user->email)
            ->with(['event' => $this->event, 'user' => $this->user]);
    }
}
