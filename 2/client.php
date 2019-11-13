<?php

include_once 'socket.php';

class ClientSocket extends Socket
{
    private $client_sock;
    private $server_side_sock;
    private $client_side_sock;

    function __construct($port, $server_sock, $client_sock)
    {
        $this->server_side_sock = dirname(__FILE__) . "/" . $server_sock;
        $this->client_side_sock = dirname(__FILE__) . "/" . $client_sock;
        self::setClientSocket($client_sock);
        parent::__construct($port, $server_sock);
        try {
            self::createSocket();
            self::bind($client_sock);

        } catch (Exception $e) {
            die($e->getMessage());
        }

    }

    /**
     * @param $client_sock
     */
    private function setClientSocket($client_sock)
    {
        $this->client_sock = $client_sock;
    }

    /**
     * @return mixed
     */
    private function getClientSocket()
    {
        return $this->client_sock;
    }

    /**
     * @throws Exception
     */
    public function run()
    {

        if (!socket_set_nonblock(self::getSocket())) {
            die('Unable to set nonblocking mode for socket');
        }
        $msg = "Ok";
        self::write($msg, $this->server_side_sock);

        if (!socket_set_block(self::getSocket()))
            die("\n\nUnable to set blocking mode for socket\n\n");
        $buf = '';
        $from = '';
        echo self::recvfrom($buf, $from);
        socket_close(self::getSocket());
        unlink($this->client_side_sock);
        echo "\nClient exits\n";
    }

}

$ini = parse_ini_file("settings.ini");
$port = $ini['port'];
$server_sock = $ini['server_sock'];
$client_sock = $ini['client_sock'];

$servSock = new ClientSocket($port, $server_sock, $client_sock);

try {
    $servSock->run();
} catch (Exception $e) {
    die($e->getMessage());
}
?>
