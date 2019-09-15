<?php
require_once __DIR__.'/../vendor/autoload.php';

use Socket\Raw\Factory;
use WebSocket\SocketHelper;

try {
    $factory = new Factory();
    //создаем сервер
    $socket = $factory->createServer(SocketHelper::ADDRESS);
    //слушаем соединение
    $socket->listen();
    while (true) {
        $client = $socket->accept();
        while ($client) {
            try {
                $message = SocketHelper::$randomMessages[mt_rand(0, count(SocketHelper::$randomMessages) - 1)];
                $client->write($message);
                $answer = $client->read(SocketHelper::READ_LENGTH_AT_ONCE);
                if ($answer === SocketHelper::ACCEPT) {
                    echo SocketHelper::showMessage(sprintf(SocketHelper::MESSAGE_ACCEPTED_BY_CLIENT, $message));
                }
                sleep(SocketHelper::SLEEP);
            } catch (Exception $e) {
                echo SocketHelper::showMessage($e->getMessage());
                break;
            }
        }
    };
    $socket->shutdown();
} catch (Exception $e) {
    echo SocketHelper::showMessage($e->getMessage());
}