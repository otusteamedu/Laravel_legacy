<?php

class Client
{

    private $socket;
    private $socketPath;


    private $serverSocketPath;

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
        $this->socketPath = dirname(__FILE__) . "/client.sock";

        $this->serverSocketPath = dirname(__FILE__) . "/server.sock";



    }

    public function setSocketPath($socketPath)
    {
        $this->socketPath = $socketPath;
    }

    public function setServerSocketPath($serverSocketPath)
    {
        $this->serverSocketPath = $serverSocketPath;
    }

    public function start()
    {
        $this->socketBind();
        $this->socketSetNonBlock();
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

    private function socketSetNonBlock()
    {
        if (!socket_set_nonblock($this->socket))
            die('Unable to set nonblocking mode for socket');
    }

    private function exec()
    {

        /**
         * Client never exits
         */

        while (true) {

            $this->socketSetBlock();

            $buf = '';
            $from = '';


            $bytesReceived = socket_recvfrom($this->socket, $buf, 65536, 0, $from);


            if ($bytesReceived == -1)
                die('An error occured while receiving from the socket');

            echo "$buf\n";


            $response = "Принято";


            // send response
            if (!socket_set_nonblock($this->socket))
                die('Unable to set nonblocking mode for socket');


            // client side socket filename is known from client request: $from
            $len = strlen($response);

            $bytesSent = socket_sendto($this->socket, $response, $len, 0, $from);

            if ($bytesSent == -1) {
                die('An error occured while sending to the socket');
            } else if ($bytesSent != $len) {
                die($bytesSent . ' bytes have been sent instead of the ' . $len . ' bytes expected');
            }

        }


    }

}


(new Client())->start();


