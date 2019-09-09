<?php


namespace Solyaris\Net;


use Throwable;

class SocketException extends \Exception
{
    public function __construct(Throwable $previous = null)
    {
        $code = socket_last_error();
        $message = socket_strerror($code);

        parent::__construct($message, $code, $previous);
    }
}