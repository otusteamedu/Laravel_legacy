#!/usr/bin/env php
<?php

use Socket\Raw\Factory;

require_once __DIR__.'/vendor/autoload.php';

$socketFile    = getSocketFile();
$socketAddress = getSocketAddress();
$factory       = new Factory();

consoleLog("Начинается запуск сервера {$socketAddress}");

try {
    if (file_exists($socketFile)) {
        unlink($socketFile);
    }

    $server = $factory->createServer($socketAddress);
} catch (\Socket\Raw\Exception $exception) {
    consoleLog("Не получилось запустить сервер {$socketAddress} из-за ошибки:");
    die($exception->getMessage().PHP_EOL);
}

consoleLog('Сервер запущен');
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

    $clientLogPrefix = 'Клиент';
    consoleLog('Соединился с клиентом');

    while (true) {
        try {
            $serverMessage = generateRandomMessage();
            $client->write($serverMessage);
            $clientResponse = $client->read(8192);

            if ('Принято' === $clientResponse) {
                consoleLog("Сообщение \"{$serverMessage}\" принято", $clientLogPrefix);
            } else {
                consoleLog("Сообщение \"{$serverMessage}\" не было доставлено", $clientLogPrefix);
                consoleLog('Соединение разорвано', $clientLogPrefix);
                consoleLog('Ожидаю соединения с клиентом');
                $client->close();

                break;
            }
        } catch (\Socket\Raw\Exception $exception) {
            consoleLog('Не получилось отправить сообщение клиенту из-за ошибки:', $clientLogPrefix);
            consoleLog($exception->getMessage(), $clientLogPrefix);
            consoleLog('Ожидаю соединения с клиентом');

            break;
        }

        sleep(getPingPongTimeout());
    }
}

consoleLog("Сервер {$socketAddress} остановлен");

$server->close();
