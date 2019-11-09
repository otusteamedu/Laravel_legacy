<?php
$host = "127.0.0.1";
$port = 20202;
set_time_limit(0);

$sock = socket_create(AF_INET, SOCK_STREAM, 0);
if(!socket_bind($sock,$host,$port)) return;
socket_listen($sock);
echo "Слушаем сервер\n\n";
do{
  $accept = socket_accept($sock);
  $msg=socket_read($accept,1024);
  echo "Пришло Сообщение: \t {$msg} \n\n";
  $ok="OK";
  socket_write($accept,$ok,strlen($ok));
}while(true);

socket_close($accept);
socket_close($sock);
