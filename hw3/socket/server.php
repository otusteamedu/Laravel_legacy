#!/usr/bin/env php
<?php

use Socket\Raw\Factory;

require_once __DIR__.'/vendor/autoload.php';

$serverAddress = getServerAddress();
$factory = new Factory();

consoleLog("Начинается запуск сервера {$serverAddress}");

try {
    $server = $factory->createServer($serverAddress);
} catch (\Socket\Raw\Exception $exception) {
    consoleLog("Не получилось запустить сервер {$serverAddress} из-за ошибки:");
    die($exception->getMessage().PHP_EOL);
}

consoleLog("Сервер {$serverAddress} запущен");
consoleLog('Ожидаю соединения с клиентом');

while ($client = $server->accept()) {
    try {
        $client->bind($server);
        $client->connect($server);
    } catch (\Socket\Raw\Exception $exception) {
        consoleLog('Не получилось соединиться с клиентом из-за ошибки:');
        consoleLog($exception->getMessage().PHP_EOL);
        consoleLog('Ожидаю соединения с клиентом');

        break;
    }

    $clientPeerName = $client->getPeerName();
    consoleLog("Соединился с клиентом {$clientPeerName}");

    while (true) {
        try {
            $serverMessage = generateRandomMessage();
            $client->write($serverMessage);
            $clientResponse = $client->read(8192);

            if ('Принято' === $clientResponse) {
                consoleLog("Сообщение \"{$serverMessage}\" принято", $clientPeerName);
            } else {
                consoleLog("Сообщение \"{$serverMessage}\" не было доставлено", $clientPeerName);
                consoleLog('Соединение разорвано', $clientPeerName);
                consoleLog('Ожидаю соединения с клиентом');
                $client->close();

                break;
            }
        } catch (\Socket\Raw\Exception $exception) {
            consoleLog('Не получилось отправить сообщение клиенту из-за ошибки:');
            consoleLog($exception->getMessage().PHP_EOL);
            consoleLog('Ожидаю соединения с клиентом');

            break;
        }

        sleep(getPingPongTimeout());
    }
}

consoleLog('Сервер '.$serverAddress.' остановлен');

$server->close();
