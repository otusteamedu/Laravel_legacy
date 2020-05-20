<?php

namespace Socket;

class Server extends AbstractUnixSocket
{
    public function __construct($socketFile, LoggerInterface $Logger)
    {
        $Logger->log('Launching socket server');

        parent::__construct($socketFile, $Logger);

        @unlink($this->socketFile);
        $this->socket = stream_socket_server($this->getSocketAddress(), $errno, $errstr);
        if (!$this->socket) {
            die(sprintf('Could not create socket server, %d %s', $errno, $errstr));
        }

        $Logger->log('Socket server ready. Waiting for client connections');
    }

    public function run()
    {
        while ($conn = stream_socket_accept($this->socket))
        {
            while (true)
            {
                $message = bin2hex(random_bytes(10));
                $res = stream_socket_sendto($conn, $message);
                if ($res < 0) {
                    $this->Logger->log('Client has disconnected');
                    break;
                }

                $revMsg = trim(stream_socket_recvfrom($conn, App::MESSAGE_MAX_LENGTH_BYTES));
                if (!feof($this->socket)) {
                    $this->Logger->log(sprintf('Message "%s" received by client', $revMsg));
                }
                sleep(App::MESSAGE_TIMEOUT);
            }
        }
    }

    public function close()
    {
        socket_close($this->socket);
    }
}
