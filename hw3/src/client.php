<?php

$host = '127.0.0.1';
$port = 20205;

$socket = socket_create(AF_INET, SOCK_STREAM, 0);
socket_connect($socket, $host, $port);

$messange = isset($_POST['messange']) ? $_POST['messange'] : '';

socket_write($socket, $messange, strlen($messange));

$reply = socket_read($accept, 1024);
$reply = trim($reply);
$reply = 'Server says: ' . $reply;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="messange">
        <button type="submit">Submit</button>
    </form>
    <textarea cols="30" rows="10"><?php echo @$reply; ?></textarea>
</body>
</html>
