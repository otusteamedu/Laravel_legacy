<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\Reason;

class NewReason extends Mailable
{
    use Queueable, SerializesModels;

    protected $reason;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Reason $reason)
    {
        $this->reason = $reason;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('example@example.com')
            ->view('mails.new_reason', ['reason' => $this->reason]);
    }
}
