#!/usr/bin/env php
<?php

use Socket\Raw\Factory;

error_reporting(-1);

require_once __DIR__.'/vendor/autoload.php';

$path = '/tmp/sct3.sock';

unlink($path);

$factory = new Factory();

try {

    $socket = $factory->createServer('unix://' . $path);

    $socket->listen();

    while (true) {

        $client = $socket->accept();

        while ($client) {
            try {
                $msq = 'Cлучайное сообщение клиенту: ' . rand();

                $client->write($msq);

                            $answer = $client->read(8192);

                            if ($answer == "Принято") {
                                echo "Сообщение " . $msq
                                    . " принято клиентом\n";
                            }

                            sleep(3);


                } catch (Exception $e) {

                    echo "Client disconected\n";
                    break;

            }
        }

    };
    $socket->shutdown();

} catch (Exception $e) {
    var_dump($e);
    echo "Connect Error";
}
