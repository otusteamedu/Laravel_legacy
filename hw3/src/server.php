<?php

while (true) {
    $message = getRandomWord();
    send_message('127.0.0.1','85',$message);
    usleep(5000000);
}

function getRandomWord($len = 10) {
    $word = array_merge(range('a', 'z'), range('A', 'Z'));
    shuffle($word);
    return substr(implode($word), 0, $len);
}

function send_message($ipServer,$portServer,$message)
{
    $fp = stream_socket_client("tcp://$ipServer:$portServer", $errno, $errstr);
    if (!$fp)
    {
        echo "ERREUR : $errno - $errstr<br />\n";
    }
    else
    {
        fwrite($fp,$message);
        $response =  fread($fp, 4);
        if ($response != "OK\n") {
            echo 'Команда не может быть исполнена :' . $response;
        }
        else {
            echo 'Принято' . PHP_EOL;
        }
        fclose($fp);
    }
}
