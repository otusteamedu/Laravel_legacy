<?php

use MaxFolder\Socket\Classes\ServerSocketDataBuilder;

header('Content-Type: text/plain;');
set_time_limit(0);
ob_implicit_flush();

$server = (new ServerSocketDataBuilder())
    ->setHost(getenv('SOCKET_HOST'))
    ->setPort(getenv('SOCKET_PORT'))
    ->setProtocolFamilyForSocket(AF_INET)
    ->setTypeOfDataExchange(SOCK_STREAM)
    ->setProtocol(SOL_TCP)
    ->setMaxByteForRead(1024)
    ->built();


try {
    $socket = $server->socketCreate();
    echo "Сокет создан\n";
} catch (Throwable $e) {
    echo $e->getMessage();
}

try {
    $res = $server->socketBind($socket);
    echo "Сокет успешно связан с адресом и портом\n";
} catch (Throwable $e) {
    echo $e->getMessage();
}


try {
    $res = $server->listen($socket);
    echo "Ждём подключение клиента\n";
} catch (Throwable $e) {
    echo $e->getMessage();
}

do {
    try {
        $socketConnection = $server->startConnectionWithSocket($socket);
    } catch (Throwable $e) {
        echo $e->getMessage();
    }

    sleep(2);
    $msg = 'Привет';
    $server->write($socketConnection, $msg);

    do {
        $socketReadResult = $server->read($socketConnection);

        if (!$socketReadResult) {
            echo 'Ошибка при чтении сообщения от клиента';
        }

        if ($socketReadResult === 'exit') {
            $server->socketClose($socketConnection);
            break 2;
        }

        if ($socketReadResult === 'Принято') {
            echo sprintf("Сообщение %s принято клиентом\n", $msg);
        }

        $msg = 'успешно';

        $server->write($socketConnection, $msg);

    } while (true);
} while (true);

if (isset($socket)) {
   $server->socketClose($socket);
    echo 'Сокет успешно закрыт';
}
