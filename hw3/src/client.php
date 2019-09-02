<?php

while (true) {
    receive_message('127.0.0.1','85',5);
}

function receive_message($ipServer,$portNumber,$nbSecondsIdle)
{
    $socket = stream_socket_server('tcp://' . $ipServer . ':' . $portNumber, $errno, $errstr);
    if (!$socket) {
        echo "$errstr ($errno)<br />\n";
    } else {
        while ($conn = @stream_socket_accept($socket,$nbSecondsIdle)) {
            $message= fread($conn, 1024);
            echo "Сообщение {$message} принято клиентом" . PHP_EOL;
            fputs ($conn, "OK\n");
            fclose ($conn);
        }

        fclose($socket);
    }
}