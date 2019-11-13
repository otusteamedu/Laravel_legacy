<?
include_once 'socket.php';



class ServerSocket extends Socket
{
    private static $instance;

    /**
     * ServerSocket constructor.
     * @param $port
     * @param $server_sock
     */
    function __construct($port, $server_sock)
    {
        parent::__construct($port, $server_sock);
        try {
            self::createSocket();
            self::bind($server_sock);

        } catch (Exception $e) {
            echo ($e->getMessage());
        }
        try {
            self::run();
        } catch (Exception $e) {
            echo ($e->getMessage());
        }
    }

    /**
     * @param $sok
     */
    protected function closeSocket($sok)
    {
        if (!socket_bind(self::getSocket(), $sok)) {
            socket_close(self::getSocket());
            unlink($sok);
        }
    }

    /**
     * @throws Exception
     */
    public function run()
    {
        while (1) {
            if (!socket_set_block(self::getSocket())) {
                throw new Exception("\n\nUnable to set blocking mode for socket\n\n");
            }
            $from = '';
            echo "Ready to receive...\n";
            echo self::read($from, $from);

            if (!socket_set_nonblock(self::getSocket())) {
                throw new Exception("\n\nUnable to set nonblocking mode for socket\n\n");
            }
            $message = rand();
            self::write($message, $from);
            echo "\nRequest processed\n";
            Sleep(2);
        }
    }

}


$ini = parse_ini_file("settings.ini");
$port = $ini['port'];
$server_sock = $ini['server_sock'];

$server = new ServerSocket($port, $server_sock);
try {
    $server->run();
}catch (Exception $e) {
    die($e->getMessage());
}