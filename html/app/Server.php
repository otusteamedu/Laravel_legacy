<?php


namespace app;

class Server extends Socket
{

    public function __construct()
    {
        $this->socketsCreate(self::SOCK_CLIENT_TO_SERVER);
        $this->sendRandomMessages();
    }

    public function sendRandomMessages()
    {
        for (; ;) {
            $msg = str_shuffle('abcdefghijklmnopqrstuvwxyz');
            $this->sendMessage($msg, self::SOCK_SERVER_TO_CLIENT);
            $this->waitMessage();
            sleep(3);
        }
    }

    public function waitMessage()
    {
        $socketAddr = self::SOCK_CLIENT_TO_SERVER;
        socket_recvfrom($this->clientSocket, $buf, 1024, 0, $socketAddr);
    }

}