<?php

function readOneLine()
{
    return rtrim(fgets(STDIN));
}

$host = '127.0.0.1';
$port = 20205;

$socket = socket_create(AF_INET, SOCK_STREAM, 0);
$socketBind = socket_bind($socket, $host, $port);

$result = socket_listen($socket, 3);
echo 'Listening socket';

while (true) {
    $accept = socket_accept($socket);
    $messange = trim(socket_read($socket, 1024));

    echo 'Server says: ' . $messange . PHP_EOL;

    echo 'Enter reply:' . PHP_EOL;
    $reply = readOneLine();

    socket_write($accept, $reply, strlen($reply));

    socket_close($socket);
}