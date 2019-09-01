<?php
header('Content-Type: text/plain;');
set_time_limit(0);
ob_implicit_flush();
$address = 'localhost';
$port = 8082;
if (($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) < 0) {
    echo "Ошибка создания сокета";
} else {
    echo "Сокет создан\n";
}

if (($ret = socket_bind($sock, $address, $port)) < 0) {
    echo "Ошибка связи сокета с адресом и портом";
} else {
    echo "Сокет успешно связан с адресом и портом\n";
}

if (($ret = socket_listen($sock, 5)) < 0) {
    echo "Ошибка при попытке прослушивания сокета";
} else {
    echo "Ждём подключение клиента\n";
}
do {
    if (($msgsock = socket_accept($sock)) < 0) {
        echo "Ошибка при старте соединений с сокетом";
    } else {
        echo "Сокет готов к приёму сообщений\n";
    }
    sleep(2);
    $msg = 'Привет';
    socket_write($msgsock, $msg,  mb_strlen($msg,'cp1251')); //Запись в сокет

    do {
        if (false === ($buf = socket_read($msgsock, 1024))) {
            echo "Ошибка при чтении сообщения от клиента";
        }

        if ($buf === 'exit') {
            socket_close($msgsock);
            break 2;
        }
        if (!is_string($buf)) {
            echo "Сообщение от сервера: передана не строка\n";
        }

        if ($buf === 'Принято') {
            echo sprintf("Сообщение %s принято клиентом\n", $msg);
        }

        $msg = mt_rand(1, 10000);
        socket_write($msgsock, $msg, mb_strlen($msg,'cp1251'));

    } while (true);
} while (true);

if (isset($sock)) {
    socket_close($sock);
    echo "Сокет успешно закрыт";
}
