<?php


namespace app;

class Client extends Socket
{

    public function __construct()
    {
        $this->socketsCreate(self::SOCK_SERVER_TO_CLIENT);
        $this->waitMessage();
    }

    public function waitMessage()
    {
        $socketAddr = self::SOCK_SERVER_TO_CLIENT;

        while (true) {
            socket_recvfrom($this->clientSocket, $buf, 1024, 0, $socketAddr);
            echo "Сообщение $buf принято клиентом\n";
            $this->sendMessage('Принято', self::SOCK_CLIENT_TO_SERVER);
        }
    }

}