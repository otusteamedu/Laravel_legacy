<?php

use MaxFolder\Socket\Classes\ClientSocketDataBuilder;
use MaxFolder\Socket\Classes\SocketException;

header('Content-Type: text/plain;');
set_time_limit(0);
ob_implicit_flush();

$client = (new ClientSocketDataBuilder())
    ->setHost(getenv('SOCKET_HOST'))
    ->setPort(getenv('SOCKET_PORT'))
    ->setProtocolFamilyForSocket(AF_INET)
    ->setTypeOfDataExchange(SOCK_STREAM)
    ->setProtocol(SOL_TCP)
    ->setMaxByteForRead(1024)
    ->built();

try {
    $socket = $client->socketCreate();
} catch(Throwable $e){
    echo $e->getMessage();
}

try {
    $connection = $client->connect($socket);
} catch (SocketException $e) {
    echo $e->getMessage();
}

do {
    sleep(1);
    $out = $client->read($socket);
    echo "Сообщение от сервера: $out.\n";
    $msg = 'Принято';
    $client->write($socket, $msg);
} while(true);


if (isset($socket)) {
    $client->socketClose($socket);
    echo 'Сокет успешно закрыт';
}

