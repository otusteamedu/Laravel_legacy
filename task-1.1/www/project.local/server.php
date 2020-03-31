<?php

$timeout = 5; // sec.
$path = '/tmp/socket.sock';

if (file_exists($path)) {
    unlink($path);
}

if (!$server = stream_socket_server('unix://' . $path, $errNo, $errStr)) {
    die("$errStr ($errNo)");
}

while ($connect = stream_socket_accept($server, 3600)) {
    $message = 'цифра - ' . rand(0, 100);
    fwrite($connect, $message . PHP_EOL);
    $read = fgets($connect);
    if ($read === 'Принято') {
        echo "Сообщение \"$message\" принято клиентом" . PHP_EOL;
    }
    fclose($connect);
    sleep($timeout);
}
fclose($server);

