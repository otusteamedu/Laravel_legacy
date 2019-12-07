<?php

namespace App\Sockets;

use App\Helpers\RandomMessageGenerator as RMG;

class Server
{
    private $socketPath;
    private $messageGenerator;
    private $clientSocket;
    private $socket;

    /**
     *
     * @param $socketPath string абсолютный путь до сокета
     * @param $messageGenerator RMG генератор случайного сообщения
     */
    public function __construct($socketPath, RMG $messageGenerator)
    {
        $this->socketPath = $socketPath;
        $this->messageGenerator = $messageGenerator;
    }

    public function run()
    {
        /* Позволяет скрипту ожидать соединения бесконечно. */
        set_time_limit(0);

        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
        if($this->socket){
            echo 'Сокет успешно создан'.PHP_EOL;
        } else {
            die('Не удалось создать сокет'.socket_strerror(socket_last_error()));
        }

        if(!socket_bind($this->socket, $this->socketPath)){
            die('socket_bind не удался: '.socket_strerror(socket_last_error()));
        }

        if(!socket_listen($this->socket,1)){
            die('Прослушивание завершилось не начавшись: '.socket_strerror(socket_last_error()));
        }

        $this->clientSocket = socket_accept($this->socket);
        echo 'Соединение установлено'.PHP_EOL;

        while (true) {
            //формируем рандомное сообщение
            $msg = $this->messageGenerator->generateRandomMessage();
            $len = strlen($msg);
            $result = socket_send($this->clientSocket, $msg, $len,MSG_DONTROUTE);
            //если отправка не удалась, то ,возможно, отключился клиент или произошла ошибка - выходим из цикла
            if(!$result) {
                break;
            }
            socket_recv($this->clientSocket, $incomingData, 1024, MSG_DONTWAIT);
            if($incomingData === 'Принято') {
                echo "Сообщение $msg принято клиентом" . PHP_EOL;
            }
            sleep(3);
        }

        $this->closeSockets();
    }

    private function closeSockets()
    {
        socket_close($this->clientSocket);
        socket_close($this->socket);
        exit('Завершаем работу');
    }
}
