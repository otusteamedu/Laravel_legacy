<?php


namespace app;


abstract class Socket
{
    const SOCK_SERVER_TO_CLIENT = '/tmp/my-server-to-client.sock';
    const SOCK_CLIENT_TO_SERVER = '/tmp/my-client-to-server.sock';

    protected $serverSocket;
    protected $clientSocket;

    public function socketsCreate(string $addr)
    {
        @unlink($addr);

        $this->serverSocket = socket_create(AF_UNIX, SOCK_DGRAM, 0);
        $this->clientSocket = socket_create(AF_UNIX, SOCK_DGRAM, 0);

        socket_bind($this->clientSocket, $addr);
    }

    public function sendMessage(string $message, string $addr)
    {
        socket_sendto($this->serverSocket, $message, strlen($message), 0, $addr, 0);
    }

    abstract public function waitMessage();

    public function __destruct()
    {
        if (is_resource($this->serverSocket)) {
            socket_close($this->serverSocket);
        }

        if (is_resource($this->clientSocket)) {
            socket_close($this->clientSocket);
        }
    }
}