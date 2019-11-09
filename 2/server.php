<?php
$host = "127.0.0.1";
$port = 20202;
while(true){
  $msg = rand();
  $sock = socket_create(AF_INET, SOCK_STREAM, 0);
  if (!socket_connect($sock,$host, $port)) {Sleep(5); continue;}
  socket_write($sock,$msg,strlen($msg));
  $reply = socket_read($sock,1024);
  $reply = trim($reply);
  echo  "Клиент: ".$reply."\n\n";
  Sleep(5);
}
?>
