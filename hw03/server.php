<?php
    if (!extension_loaded('sockets')) {
        die('Нет расширения для работы с сокетами');
    }

    $socketFile = __DIR__ . '/server.sock';
    unlink($socketFile);

    $transport = 'unix://';
    $msg = 'Test';
    $sendMsg = '';
    $i = 1;
    $finish = 20;
    $timeWait = 1;

    $socket = stream_socket_server($transport . $socketFile, $errno, $errstr);

    if (!$socket) {
        die ($errstr . PHP_EOL);
    }

    while ($conn = stream_socket_accept($socket)) {
        while ($i <= $finish) {
            $sendMsg = $i . ':' . $msg . PHP_EOL;

            $res = stream_socket_sendto($conn, $sendMsg);

            if ($res < 0) {
                echo 'Клиент отключился';
                break;
            }

            $i++;

            $revMsg = stream_socket_recvfrom($conn, 1024);

            if (!feof($socket)) {
                echo $revMsg . PHP_EOL;
            }

            sleep($timeWait);
        }
        fclose($conn);
    }

    fclose($socket);
