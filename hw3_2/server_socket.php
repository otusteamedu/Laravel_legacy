<?php

class Server
{
    private $socket;
    private $socketPath;

    private $clientSocketPath;

    public function __construct()
    {
        if (!extension_loaded('sockets')) {
            die('The sockets extension is not loaded.');
        }


        $socket = socket_create(AF_UNIX, SOCK_DGRAM, 0);

        if (!$socket) {
            die('Unable to create AF_UNIX socket');
        }

        $this->socket = $socket;
        $this->socketPath = dirname(__FILE__) . "/server.sock";

        $this->clientSocketPath = dirname(__FILE__) . "/client.sock";


    }

    public function setSocketPath(string $socketPath)
    {
        $this->socketPath = $socketPath;
    }

    public function setServerSocketPath($clientSocketPath)
    {
        $this->clientSocketPath = $clientSocketPath;
    }

    public function start()
    {
        $this->socketBind();
        $this->exec();
    }

    private function closeSocket()
    {
            socket_close($this->socket);
            unlink($this->socketPath);

    }

    private function socketBind()
    {

        if (!socket_bind($this->socket, $this->socketPath))
            die("Unable to bind to $this->socketPath");

    }

    /**
     * receive query
     */
    private function socketSetBlock()
    {
        if (!socket_set_block($this->socket))
            die('Unable to set blocking mode for socket');
    }


    private function exec()
    {
        while (true) {

            $msg = uniqid();
            $len = strlen($msg);

            $bytesSent = socket_sendto($this->socket, $msg, $len, 0, $this->clientSocketPath);

            if ($bytesSent == -1)
                die('An error occured while sending to the socket');
            else if ($bytesSent != $len)
                die($bytesSent . ' bytes have been sent instead of the ' . $len . ' bytes expected');


            $this->socketSetBlock();

            $buf = '';
            $from = '';

            $bytes_received = socket_recvfrom($this->socket, $buf, 65536, 0, $from);

            if ($bytes_received == -1)
                die('An error occured while receiving from the socket');
            echo "Сообщение $msg принято клиентом \n";

            sleep(2);
        }

    }

}

(new Server())->start();

