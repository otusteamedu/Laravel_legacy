<?php
if (!extension_loaded('sockets')) {
    echo 'The sockets extension is not loaded';
    exit(1);
};

/**
 * @param string $path
 * @return resource
 * @throws Exception
 */
function createUnixSocket(string $path)
{
    $socket = socket_create(AF_UNIX, SOCK_DGRAM, 0);
    if (!$socket) throw new Exception('Unable to create AF_UNIX socket');
    if(file_exists($path) !== false) unlink($path);
    if (!socket_bind($socket, $path)) throw new Exception("Unable to bind to $path");

    return $socket;
}

/**
 * @param resource $socket
 * @return array
 * @throws Exception
 */
function listenUnixSocket($socket) :array
{
    if (!socket_set_block($socket)) throw new Exception('Unable to set blocking mode for socket');
    $buf = $from = '';
    $bytes_received = socket_recvfrom($socket, $buf, 65536, 0, $from);
    if ($bytes_received == -1) throw new Exception('An error occurred while receiving from the socket');

    return [$buf, $from];
}

/**
 * @param resource $socket
 * @param string $sendTo
 * @param string|null $message
 * @return void
 * @throws Exception
 */
function sendResponse($socket, string $sendTo, ?string $message = '') :void
{
    if (!socket_set_nonblock($socket)) throw new Exception('Unable to set nonblocking mode for socket');
    $len = strlen($message);
    $bytes_sent = socket_sendto($socket, $message, $len, 0, $sendTo);
    if ($bytes_sent == -1) {
        throw new Exception('An error occured while sending to the socket');
    } else if ($bytes_sent != $len) {
        throw new Exception("{$bytes_sent} bytes have been sent instead of the {$len} bytes expected");
    }
}