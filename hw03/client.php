<?php
    $socketFile = __DIR__ . '/server.sock';
    $revMsg = 'Получил: ';
    $socket = stream_socket_client('unix://' . $socketFile, $errno, $errstr, 30);
    
    if (!$socket) {
        die($errstr . PHP_EOL);
    }

    while (true) {
        while (!feof($socket)) {
            $msg = stream_socket_recvfrom($socket, 1024);
            echo $msg;
            $revMsg = $revMsg . $msg . PHP_EOL;
            stream_socket_sendto($socket, $revMsg);
        }
    }

    fclose($fp);