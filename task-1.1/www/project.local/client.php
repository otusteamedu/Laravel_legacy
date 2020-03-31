<?php

$path = '/tmp/socket.sock';

do {
    if (!$client = stream_socket_client('unix://' . $path, $errNo, $errStr, 30)) {
        die("$errStr ($errNo)");
    }
    echo fgets($client);
    fwrite($client, 'Принято');
    fclose($client);
} while (true);

