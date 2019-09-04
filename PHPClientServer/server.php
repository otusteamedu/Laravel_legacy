#!/usr/bin/env php
<?php

include_once('./app/Socket.php');

unlink((new Socket())->getSocketFile());

if (!$socket = (new Socket())->connectServer()) {
    die('Соединение не установлено');
}

while ($conn = stream_socket_accept($socket)) {
    (new Socket())->serverWork($socket, $conn);
    fclose($conn);
}
socket_close($socket);
