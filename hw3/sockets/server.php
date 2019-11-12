#!/usr/bin/env php
<?php

include("config.php");

if (file_exists($soket_file)){
    unlink($soket_file);
}

if( ($unixSocket = stream_socket_server(sprintf('%s%s', 'unix://',$soket_file), $errno, $errstr)) === false) {
    die('Соединение не установлено');
}else {
    echo "Соединение установлено". "\n";;
}

while ($conn = stream_socket_accept($unixSocket)) {
    $itter = 1;
    while (true) {
        $message = 'Cлучайное сообщение клиенту: ' . rand();
        $sendMsg = sprintf('%d:%s%s', $itter, $message, PHP_EOL);
        $res = stream_socket_sendto($conn, $sendMsg);
        if ($res < 0) {
            echo 'Клиент отключился';
            break;
        }
        $itter++;
        $revMsg = trim(stream_socket_recvfrom($conn, 1024));
        if (!feof($unixSocket)) {
            echo sprintf('Сообщение "%s" принято клиентом %s', $revMsg, PHP_EOL);
        }
        sleep(2);
    }
 fclose($conn);
}
socket_close($unixSocket);
