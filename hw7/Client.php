<?php


namespace Hw7;


class Client implements ClientInterface
{
    protected $socket;
    protected $resource;

    public function __construct($socket)
    {
        $this->socket = $socket;
    }

    public function read(callable $callable)
    {
        $resource = $this->connection();

        while (true) {
            while (!feof($resource)) {
                $message = stream_socket_recvfrom($resource, 1024);
                echo $message.PHP_EOL;
                stream_socket_sendto($resource, Server::ACCEPTED);
            }
        }
        fclose($resource);
    }

    protected function connection()
    {
        if($this->resource) {
            return $this->resource;
        }

        $resource = stream_socket_client($this->socket, $errno, $errstr, 30);

        if (!$resource) {
            throw new ClientException($errstr, $errno);
        }

        return $this->resource = $resource;
    }
}
