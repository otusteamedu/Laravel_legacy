#!/usr/local/bin/php -q
<?php
include('settings.php');

$socket = stream_socket_server($socketTransport . $socketName, $errNo, $errStr);

if (!$socket) {

    echo sprintf("Ошибка создания сокета: %s (%d)<br />\n", $errStr, $errNo);

} else {

    echo 'Ожидаем соединения' . "\n";

    while ($connection = stream_socket_accept($socket, $connectionTimeSeconds)) {

        echo 'Клиент подключился' . "\n";

        $c = 0;
        while ($c <= $limitMessages) {

            $message = rand(0, 1000);

            $res = fputs($connection, $message);
            if ($res < 0) {
                echo 'Связь с клиентом прервана';
                break;
            }

            echo 'Отправлено: '.$message . "\n";

            $response = fread($connection, 1024);
            if ($response) {
                echo 'Ответ: ' . $response . "\n";
            } else {
                echo 'Нет ответа:' . $response . "\n";
            }

            $c++;
            sleep(1);
        }

        fclose($connection);
        echo 'Соединение закрыто' . "\n";
    }

    fclose($socket);
}
