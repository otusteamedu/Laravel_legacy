<?php

namespace Hb;

use Hb\Socket\Exception;

class Client extends Socket\Application
{
    const MODE = 'client';

    /**
     * Client constructor
     * @throws Exception
     */
    public function __construct()
    {
        $this->openClientSockets();
        $this->setBlockMode(false);
    }

    /**
     * @throws Exception
     */
    protected function openClientSockets()
    {
        $this->client_socket = stream_socket_client("unix://" . self::CLIENT_SOCKET);
        if (!is_resource($this->client_socket)) {
            throw new Exception('can`t create client socket');
        }

        $this->server_socket = stream_socket_client("unix://" . self::SERVER_SOCKET, $errno, $errstr);
        if (!is_resource($this->server_socket)) {
            throw new Exception('can`t stream server socket');
        }
    }

    /**
     * Run client side
     */
    public function run()
    {
        while (true) {
            $msg = trim(fgets($this->server_socket, 1024));
            if ($msg) {
                $this->echoMsg('"' . $msg . '"');
                fwrite($this->client_socket, 'Принято' . PHP_EOL);
            }
        }
    }
}