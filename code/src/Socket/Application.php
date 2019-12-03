<?php

namespace Hb\Socket;

abstract class Application
{
    const SERVER_SOCKET = '/code/server.sock';
    const CLIENT_SOCKET = '/code/client.sock';
    const MAX_TIMEOUT = 2;

    protected $server_socket;
    protected $client_socket;

    abstract function run();

    public function echoMsg($msg, $type = 'server')
    {
        echo static::MODE.': '.$msg.PHP_EOL;
    }

    protected function acceptSockets()
    {
        $this->server_socket = stream_socket_accept($this->server_socket);
        $this->client_socket = stream_socket_accept($this->client_socket);

    }

    protected function clear()
    {
        @unlink(self::SERVER_SOCKET);
        @unlink(self::CLIENT_SOCKET);
    }

    protected function setBlockMode($mode = false)
    {
        stream_set_blocking($this->server_socket, $mode);
        stream_set_blocking($this->client_socket, $mode);
    }
}