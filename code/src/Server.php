<?php

namespace Hb;

use Hb\Socket\Exception;

class Server extends Socket\Application
{
    const MODE = 'server';

    protected $messages = [];

    /**
     * Server constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->clear();
        $this->openServerSockets();
        $this->setBlockMode(false);
        $this->acceptSockets();
    }

    /**
     * @throws Exception
     */
    protected function openServerSockets()
    {
        $this->server_socket = stream_socket_server("unix://" . self::SERVER_SOCKET);
        if (!is_resource($this->server_socket)) {
            throw new Exception('can`t create server socket');
        }

        $this->client_socket = stream_socket_server("unix://" . self::CLIENT_SOCKET, $errno, $errstr);
        if (!is_resource($this->client_socket)) {
            throw new Exception('can`t create client socket');
        }
    }

    /**
     * Run server side
     */
    public function run()
    {
        while (true) {

            $msg = $this->getMessage(mt_rand(5, 10));
            $this->messages[] = $msg;
            fwrite($this->server_socket, $msg . PHP_EOL);
            $this->echoMsg('отправлено "' . $msg . '"');

            $accept = trim(fgets($this->client_socket));
            if ($accept && $accept == 'Принято') {
                $firstMsg = array_shift($this->messages);
                $this->echoMsg('Сообщение "' . $firstMsg . '" принято клиентом');
            }

            sleep(self::MAX_TIMEOUT);
        }
    }

    /**
     * Get message to send
     * @param $length
     * @param array $chars
     * @return string
     */
    function getMessage($length, $chars = [])
    {
        if (empty($chars)) {
            $chars = 'qwertyuiopasdfghjklzxcvbnm';
        }

        $msg = "";
        $lenChars = strlen($chars);

        for ($i = 0; $i < $length; $i++) {
            $randI = mt_rand(1, $lenChars);
            $chr = $chars[$randI - 1];
            $msg .= $chr;
        }

        return $msg;
    }
}