<?php

require_once __DIR__ . '/vendor/autoload.php';

use Socket\Raw\Factory;

$factory = new Factory();

echo 'Соединение с сервером...' . PHP_EOL;

try {
    $server = $factory->createServer(getSocketFilePath());
} catch (\Socket\Raw\Exception $e) {
    die($e->getMessage());
}

echo 'Сервер запущен' . PHP_EOL;

while ($client = $server->accept()) {
    try {
        $client->bind($server);
        $client->connect($server);
    } catch (\Socket\Raw\Exception $e) {
        die($e->getMessage());

        break;
    }

    echo 'Соединение с клиентов прошло успешно' . PHP_EOL;

    while (true) {
        try {
            $message = getRandomMessage();
            $client->write($message);
            $response = $client->read(1024);

            if ($response === 'Принято') {
                echo 'Сообщение принято' . PHP_EOL;
            } else {
                echo 'Сообщение не было доставлено' . PHP_EOL;
                $client->close();

                break;
            }
        } catch (\Socket\Raw\Exception $e) {
            die($e->getMessage());
        }

        sleep(5);
    }
}

echo 'Сервер остановлен' . PHP_EOL;

$server->close();