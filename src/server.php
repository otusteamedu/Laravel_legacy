<?php
$waitBeforeSend = getenv('OTUS_WAIT_BEFORE_SEND') ?: 2;
$socketFile = getenv('OTUS_SOCKET') ?: "/tmp/otus_server.sock";

if (file_exists($socketFile)) {
    unlink($socketFile);
}

$server = stream_socket_server("unix://$socketFile", $errno, $errstr);

if (!$server) {
    die("$errno: $errstr");
}

while (true) {
    echo "Ждём подключение на $socketFile" . PHP_EOL;
    $client = @stream_socket_accept($server);
    if ($client) {
        echo "Подключился клиент. Раз в $waitBeforeSend секунды будем отправлять ему сообщение" . PHP_EOL;

        while (true) {
            sleep($waitBeforeSend);
            $msgToClient = 'random message ' . random_int(0, 100);
            $res = @fwrite($client, $msgToClient . PHP_EOL);
            if (!$res) {
                echo 'Клиент отключился' . PHP_EOL;
                break;
            }
            fgets($client);
            echo "Сообщение $msgToClient принято клиентом" . PHP_EOL;
        }
    }
}
