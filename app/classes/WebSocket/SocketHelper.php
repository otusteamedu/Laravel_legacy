<?php

namespace WebSocket;

/**
 * Class SocketHelper
 * @package WebSocket
 */
class SocketHelper
{
    /** @var string адрес сокета */
    public const ADDRESS = "tcp://0.0.0.0:80";
    /** @var string */
    public const ACCEPT = "Принято";
    /** @var string */
    public const MESSAGE_ACCEPTED_BY_CLIENT = "Сообщение %s принято клиентом";
    public const CLIENT = "Client";
    /** @var int Количество байт читаемых за раз */
    public const READ_LENGTH_AT_ONCE = 8192;
    /** @var int задержка отправки сообщений */
    public const SLEEP = 3;
    /** @var array список сообщений */
    public static $randomMessages = [
        'Hello',
        'How are you?',
        'Who are you?',
        'Where are you from?',
        'What your name?',
        'What are you waiting for?',
    ];

    /**
     * Вывести сообщение. В начало добавить от кого оно. В конец перенос на новую строку.
     * @param  string  $message
     * @param  string  $sender
     * @return string
     */
    public static function showMessage(string $message, $sender = 'Server'): string
    {
        return sprintf("%s: %s".PHP_EOL, $sender, $message);
    }
}