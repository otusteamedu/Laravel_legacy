<?php


namespace app;

class Client extends Socket
{

    public function __construct()
    {
        $this->socket = stream_socket_client("unix://" . self::LOCAL_SOCKET, $errno, $errstr);
        if (is_resource($this->socket)) {
            $this->waitMessage();
        }
    }

    public function waitMessage()
    {
        while (true) {
            $msg = trim(fgets($this->socket));
            echo "Сообщение $msg принято клиентом" . PHP_EOL;
            fwrite($this->socket, 'Принято' . PHP_EOL);
        }
    }

}