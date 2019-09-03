#!/usr/bin/env php
<?php

use Socket\Raw\Factory;

require_once __DIR__.'/vendor/autoload.php';

$socketAddress = getSocketAddress();
$factory       = new Factory();

consoleLog('Соединяюсь с сервером '.$socketAddress);

try {
    $client = $factory->createClient($socketAddress);
} catch (\Socket\Raw\Exception $exception) {
    consoleLog("Не получилось соединиться с сервером {$socketAddress} из-за ошибки:");
    die($exception->getMessage().PHP_EOL);
}

consoleLog('Соединение установлено');

while ($message = $client->read(8192)) {
    consoleLog("Сообщение от сервера: \"{$message}\"");
    $client->write('Принято');
}

consoleLog('Соединение с сервером разорвано');

$client->close();
