<?php
header('Content-Type: text/plain;');
set_time_limit(0);
ob_implicit_flush();
$address = 'localhost';
$port = 8082;
if (($socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) < 0) {
    echo "Ошибка создания сокета";
} else {
    echo "Сокет создан\n";
}
$result = socket_connect($socket, $address, $port);
if ($result === false) {
    echo "Ошибка при подключении к сокету";
} else {
    echo "Подключение к сокету прошло успешно\n";
}

do {
    sleep(1);
    $out = socket_read($socket, 1024);
    echo "Сообщение от сервера: $out.\n";
    $msg = 'Принято';
    socket_write($socket, $msg,  mb_strlen($msg,'cp1251'));
} while(true);


if (isset($socket)) {
    socket_close($socket);
    echo "Сокет успешно закрыт";
}

