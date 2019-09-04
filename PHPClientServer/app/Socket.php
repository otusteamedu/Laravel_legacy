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

    public function __construct()
    {
        $this->socketFile = '/tmp/myserver.sock';
        $this->message = 'Test';
        $this->itter = 1;
    }

    /**
     * @return mixed
     */
    public function getSocketFile()
    {
        return $this->socketFile;
    }

    public function connectClient()
    {

        return stream_socket_client(sprintf('%s%s', 'unix://', $this->socketFile), $errno, $errstr, 30);

    }

    public function connectServer()
    {
        return stream_socket_server(sprintf('%s%s', 'unix://', $this->socketFile), $errno, $errstr);
    }

    public function connectError()
    {
        die('Соединение не установлено');
    }

    public function clientWorks($socket)
    {
        while (true) {
            while (!feof($socket)) {
                $msg = stream_socket_recvfrom($socket, 1024);
                echo sprintf('Принято %s', $msg);
                stream_socket_sendto($socket, $msg);
            }
        }
    }

    public function serverWork($socket, $conn)
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