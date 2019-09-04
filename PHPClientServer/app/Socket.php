<?php
/**
 * Created by PhpStorm.
 * User: Hollow
 * Date: 04.09.2019
 * Time: 19:57
 */

class Socket
{
    private $socketFile;
    private $message;
    private $itter;

    /**
     * Socket constructor.
     * @param string $socketFile
     * @param string $message
     * @param int $itter
     */
    public function __construct(string $socketFile, string $message, int $itter)
    {
        $this->socketFile = $socketFile;
        $this->message = $message;
        $this->itter = $itter;
    }

    /**
     * @return string
     */
    public function getSocketFile(): string
    {
        return $this->socketFile;
    }

    /**
     * @return bool|resource
     */
    public function connectClient()
    {

        return stream_socket_client(sprintf('%s%s', 'unix://', $this->socketFile), $errno, $errstr, 30);

    }

    /**
     * @return bool|resource
     */
    public function connectServer()
    {
        return stream_socket_server(sprintf('%s%s', 'unix://', $this->socketFile), $errno, $errstr);
    }

    /**
     * false connection
     */
    public function connectError()
    {
        die('Соединение не установлено');
    }

    /**
     * @param resource
     */
    public function clientReceivingSendingMessage($socket)
    {
        while (true) {
            while (!feof($socket)) {
                $msg = stream_socket_recvfrom($socket, 1024);
                echo sprintf('Принято %s', $msg);
                stream_socket_sendto($socket, $msg);
            }
        }
    }

    /**
     * @param $socket resource
     * @param $conn resource
     */
    public function serverReceivingSendingMessage($socket, $conn)
    {
        while (true) {
            $sendMsg = sprintf('%d:%s%s', $this->itter, $this->message, PHP_EOL);
            $res = stream_socket_sendto($conn, $sendMsg);
            if ($res < 0) {
                echo 'Клиент отключился';
                break;
            }
            $this->itter++;
            $revMsg = trim(stream_socket_recvfrom($conn, 1024));
            if (!feof($socket)) {
                echo sprintf('Сообщение "%s" принято клиентом %s', $revMsg, PHP_EOL);
            }
            sleep(1);
        }
    }

}