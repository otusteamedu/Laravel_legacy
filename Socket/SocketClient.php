<?php


class SocketClient
{
    protected string $host = '127.0.0.1';
    protected int $port = 5353;
    protected int $maxBytesForRead = 1024;

    public function __construct(string $host = null, int $port = null)
    {
        $this->host = $host ?? $this->host;
        $this->port = $port ?? $this->port;
    }

    public function handle(): void
    {
        if (($socket = socket_create(AF_INET, SOCK_STREAM, 0)) === false) {
            echo "Socket create error\n";
            die();
        }

        if ((socket_connect($socket, $this->host, $this->port)) === false) {
            echo "Socket connect error\n";
            die();
        }

        while (true) {
            $readResult = socket_read($socket, $this->maxBytesForRead);
            echo $readResult . "\n";

            socket_write($socket, 'Received');
        }
    }
}
