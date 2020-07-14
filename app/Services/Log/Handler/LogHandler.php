<?php


namespace App\Services\Log\Handler;

use Auth;

class LogHandler
{

    public function logDaily($message)
    {
        $context =['USER' =>'#'.Auth::user()->id.'->'.Auth::user()->name];
        \Log::channel('daily')->info(__METHOD__ . $message, $context);
    }

    public function logSlack($message)
    {
        \Log::channel('slack')->critical(__METHOD__ . $message);
    }

}
