<?php

namespace Socket;

class Client extends AbstractUnixSocket
{
    public function __construct($socketFile, LoggerInterface $Logger)
    {
        $Logger->log('Launching socket client');

        parent::__construct($socketFile, $Logger);

        $this->socket = stream_socket_client($this->getSocketAddress(), $errno, $errstr);
        if (!$this->socket) {

            die(sprintf("Could not create socket client, %d %s\n", $errno, $errstr));
        }

        $Logger->log('Socket client ready');
    }

    public function run()
    {
        while (!feof($this->socket))
        {
            $message = stream_socket_recvfrom($this->socket, App::MESSAGE_MAX_LENGTH_BYTES);
            if (empty($message)) {
                break;
            }
            $this->Logger->log(sprintf('Received: %s', $message));
            stream_socket_sendto($this->socket, $message);
        }

        $this->Logger->log('Cannot connect to server, closing');

        $this->close();
    }

    public function close()
    {
        socket_close($this->socket);
    }
}
