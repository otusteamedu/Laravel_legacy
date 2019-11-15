<?
namespace Socket;

class Socket
{
    private $port;
    protected $server_sock;
    private $socket;

    function __construct($port, $server_sock)
    {
        if (!extension_loaded('sockets')) {
            throw new Exeption("\n\nThe sockets extension is not loaded.\n\n");
        }
        self::setPort($port);
        self::setServerSocket($server_sock);
    }

    /**
     * @param $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * @return mixed
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param $server_sock
     */
    public function setServerSocket($server_sock)
    {
        $this->server_sock = $server_sock;
    }

    /**
     * @return mixed
     */
    public function getServerSocket()
    {
        return $this->server_sock;
    }

    /**
     * createSocket
     */
    protected function createSocket()
    {

        $socket = socket_create(AF_UNIX, SOCK_DGRAM, 0);
        if (!$socket) {
            throw new Exeption ("\n\nUnable to create AF_UNIX socket\n\n");
        }
        $this->socket = $socket;
    }

    /**
     * @param $socket
     */
    protected function setSocket($socket)
    {
        $this->socket = $socket;
    }

    /**
     * @return mixed
     */
    protected function getSocket(){
        return $this->socket;
    }

    /**
     * @param $side_sock
     */
    protected function closeSocket($side_sock)
    {

       socket_close($this->socket);
       unlink($side_sock);

    }

    /**
     * @param $sock
     * @return bool
     */
    protected function bind($sock)
    {
        $side_sock = dirname(__FILE__) ."/".$sock;
        if (!socket_bind(self::getSocket(), $side_sock)) {
            return false;
        }
        return true;
    }

    /**
     * @param $buf
     * @param $from
     * @throws Exception
     */
    protected function write($buf, $from)
    {
        $len = strlen($buf);
        $bytes_sent = socket_sendto(self::getSocket(), $buf, $len, 0, $from);
        if ($bytes_sent == -1) {
            throw new Exception("\n\nAn error occured while sending to the socket\n\n");
        } else if ($bytes_sent != $len)
            throw new Exception($bytes_sent . ' bytes have been sent instead of the ' . $len . ' bytes expected');
    }

    /**
     * @param $buf
     * @param $from
     * @return string
     * @throws Exception
     */
    protected function recvfrom($buf, $from)
    {
        $bytes_received = socket_recvfrom(self::getSocket(), $buf, self::getPort(), 0, $from);
        if ($bytes_received == -1) {
            throw new Exception("\n\nAn error occured while receiving from the socket\n\n");
        }
        return "\nReceived:\n $buf\nFrom:\n $from\n";
    }

    /**
     * @param $from
     * @return string
     * @throws Exception
     */
    protected function read(&$from)
    {
        $bytes_received = socket_recvfrom(self::getSocket(), $buf, self::getPort(), 0, $from);
        if ($bytes_received == -1) {
            throw new Exception("\n\nAn error occured while receiving from the socket\n\n");
        }
        return "\n\nReceived:\n $buf \nFrom:\n $from\n\n";
    }


}