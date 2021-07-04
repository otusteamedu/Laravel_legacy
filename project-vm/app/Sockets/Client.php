<?php

namespace App\Sockets;

class Client
{
    private $socketPath;
    private $socket;

    /**
     *
     * @param $socketPath string путь до сокета
     */
    public function __construct($socketPath)
    {
        $this->socketPath = $socketPath;
    }


    public function run()
    {
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);

        socket_connect($this->socket, $this->socketPath);

        while (true) {
            if($response = socket_read($this->socket, 1024)){
                echo $response.PHP_EOL;
                $msg = 'Принято';
                $length = strlen($msg);
                socket_write($this->socket, $msg, $length);
            }
        }
    }
}