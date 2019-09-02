#!/usr/bin/env php
<?php

use Socket\Raw\Factory;

require_once __DIR__.'/vendor/autoload.php';

$serverAddress = getServerAddress();
$factory = new Factory();

consoleLog('Соединяюсь с сервером ' . $serverAddress);

try {
    $client = $factory->createClient($serverAddress);
} catch (\Socket\Raw\Exception $exception) {
    consoleLog("Не получилось соединиться с сервером {$serverAddress} из-за ошибки:");
    die($exception->getMessage() . PHP_EOL);
}

$clientSockName = $client->getSockName();

consoleLog('Соединение установлено');
consoleLog("Запущен клиент {$clientSockName}");

while ($message = $client->read(8192)) {
    consoleLog("Сообщение от сервера: \"{$message}\"");
    $client->write('Принято');
}

consoleLog("Клиент {$clientSockName} остановлен");
consoleLog('Соединение с сервером разорвано');

$client->close();
