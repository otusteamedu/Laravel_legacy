<?php
require_once __DIR__.'/../vendor/autoload.php';

use Socket\Raw\Factory;
use WebSocket\SocketHelper;

$factory = new Factory();

//создаем клиента сокета
$socket = $factory->createClient(SocketHelper::ADDRESS);

while (true) {
    //читаем из сокета
    $message = $socket->read(SocketHelper::READ_LENGTH_AT_ONCE);
    //выводим
    echo SocketHelper::showMessage($message, SocketHelper::CLIENT);
    //отвечаем серверу, что приняли
    $socket->write(SocketHelper::ACCEPT);
}

$socket->close();