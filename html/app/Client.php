<?php

namespace app;

/**
 * Class Client
 * @package app
 */
class Client extends Socket
{

    /**
     * Создает сокет клиента, переводит скрипт в режим ожидания
     */
    public function __construct()
    {
        $this->socket = stream_socket_client("unix://" . self::LOCAL_SOCKET);
        if (is_resource($this->socket)) {
            $this->waitMessage();
        }
    }

    /**
     * Ждет сообщение от сервера, отсылает ответ
     * @return void
     */
    public function waitMessage(): void
    {
        while (true) {
            $msg = fgets($this->socket);

            if ($msg === false) {
                break;
            }

            $msg = trim($msg);
            echo "Сообщение $msg принято клиентом" . PHP_EOL;
            fwrite($this->socket, 'Принято' . PHP_EOL);
        }
    }

}