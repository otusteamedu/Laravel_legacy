<?php
/* Позволяет скрипту ожидать соединения бесконечно. */
set_time_limit(0);

require_once __DIR__ . '/RandomMessageGenerator.php';

$address = '/tmp/mysock.sock';

$socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
if($socket){
    echo 'Сокет успешно создан'.PHP_EOL;
} else {
    die('Не удалось создать сокет'.socket_strerror(socket_last_error()));
}

if(!socket_bind($socket, $address)){
    die('socket_bind не удался: '.socket_strerror(socket_last_error()));
}

if(!socket_listen($socket,1)){
    die('Прослушивание завершилось не начавшись: '.socket_strerror(socket_last_error()));
}

$messageGenerator = new RandomMessageGenerator();
$clientSocket = socket_accept($socket);
echo 'Соединение установлено'.PHP_EOL;

while (true) {
    //формируем рандомное сообщение
    $msg = $messageGenerator->generateRandomMessage();
    $len = strlen($msg);
    $result = socket_send($clientSocket, $msg, $len,MSG_DONTROUTE);
    //если отправка не удалась, то ,возможно, отключился клиент или произошла ошибка - выходим из цикла
    if(!$result) {
        break;
    }
    socket_recv($clientSocket, $incomingData, 1024, MSG_DONTWAIT);
    if($incomingData === 'Принято') {
        echo "Сообщение $msg принято клиентом" . PHP_EOL;
    }
    sleep(3);
}


socket_close($clientSocket);
socket_close($socket);
exit('Завершаем работу');