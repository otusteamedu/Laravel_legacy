<?php

namespace app;

/**
 * Class Server
 * @package app
 */
class Server extends Socket
{

    /**
     * Создает сокет сервера, переводит скрипт в режим отправителя
     */
    public function __construct()
    {
        @unlink(self::LOCAL_SOCKET);
        $this->socket = stream_socket_server("unix://" . self::LOCAL_SOCKET);
        if (is_resource($this->socket)) {
            $this->socket = stream_socket_accept($this->socket);
            $this->sendMessages();
        }
    }

    /**
     * Отправляет случайное сообщение клиенту
     * @return void
     */
    public function sendMessages(): void
    {
        while (true) {
            fwrite($this->socket, str_shuffle('abcdefghijklmnopqrstuvwxyz') . PHP_EOL);
            sleep(self::SOCKET_TIMEOUT);
        }
    }

}