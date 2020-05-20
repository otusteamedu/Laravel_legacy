<?php

namespace Socket;

class Logger implements LoggerInterface
{
    public function log($message)
    {
        echo sprintf("%s: %s\n", date("H:i:s"), $message);
    }
}
