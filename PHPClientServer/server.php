#!/usr/bin/env php
<?php

include_once('./app/Socket.php');

$unixSocket = new Socket('/tmp/myserver.sock','Test',1);
unlink($unixSocket->getSocketFile());

if (!$socket = $unixSocket->connectServer()) {
    die('Соединение не установлено');
}

while ($conn = stream_socket_accept($socket)) {
    $unixSocket->serverReceivingSendingMessage($socket, $conn);
    fclose($conn);
}
socket_close($socket);
