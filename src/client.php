<?php
$socketFile = getenv('OTUS_SOCKET') ?: "/tmp/otus_server.sock";

$fp = @stream_socket_client("unix://$socketFile", $errno, $errstr);

if (!$fp) {
    die("$errno: $errstr");
}

while (!feof($fp))
{
    // Receive one line from server
    $msgFromServer = fgets($fp);
    echo $msgFromServer;

    // Send ack message to the server
    $res = @fwrite($fp, "принято" . PHP_EOL);
    if (!$res) {
        echo "Сервер отключился, завершаем работу" . PHP_EOL;
        break;
    }
}

fclose($fp);
