<?php

require_once __DIR__ . '/vendor/autoload.php';

use Socket\Raw\Factory;

$factory = new Factory();

try {
    $client = $factory->createClient(getSocketFilePath());
} catch (\Socket\Raw\Exception $e) {
    die($e->getMessage());
}

echo 'Соединение установлено' . PHP_EOL;

while (true) {
    $message = $client->read(1024);
    echo "Сообщение {$message} принято" . PHP_EOL;
    $client->write('Принято');
}

echo 'Соединение остановлено';

$client->close();