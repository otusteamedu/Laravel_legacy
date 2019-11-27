<?php

namespace Lara\Callback\Http\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Http\Request;

class  CallbackOrderMail extends Mailable
{
    //use Queueable, SerializesModels;

    private $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('callback::mails.callback.index',$this->data);
    }
}
