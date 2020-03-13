<?php


class SocketServer
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
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die("Could not create socket\n");
        $res = socket_bind($socket, $this->host, $this->port) or die("Could not bind to socket\n");
        $res = socket_listen($socket, 3) or die("Could not set up socket listener\n");

        while (true) {
            if (($socketConnection = socket_accept($socket)) === false) {
                echo "Accepts a connection on a socket error\n";
                die();
            }

            $baseMsg = $msg = 'Random message';
            socket_write($socketConnection, $baseMsg);

            while (true) {
                sleep(2);

                if (($readResult = socket_read($socketConnection, $this->maxBytesForRead)) === false) {
                    echo "Read error\n";
                }

                echo "Message `$msg` was received\n";
                $msg = $baseMsg . random_int(1, 100);

                socket_write($socketConnection, $msg);
            }
        }
    }
}
