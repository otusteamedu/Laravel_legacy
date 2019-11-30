<?php


namespace app;

class Server extends Socket
{

    public function __construct()
    {
        @unlink(self::LOCAL_SOCKET);
        $this->socket = stream_socket_server("unix://" . self::LOCAL_SOCKET);
        if (is_resource($this->socket)) {
            $this->socket = stream_socket_accept($this->socket);
            $this->sendMessages();
        }
    }

    public function sendMessages()
    {
        while (true) {
            fwrite($this->socket, str_shuffle('abcdefghijklmnopqrstuvwxyz') . PHP_EOL);
            sleep(self::SOCKET_TIMEOUT);
        }
    }

}