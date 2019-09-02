<?php


namespace Hw7;


use Illuminate\Support\Str;

class Server implements ServerInterface
{
    const ACCEPTED = 'Accepted';

    protected $socket;
    protected $resource;

    public function __construct(string $socket)
    {
        $this->socket = $socket;
    }

    /**
     * Ждем клиента, отправляем ему сообщение и в зависимости от результата выводим сообщение
     * @param callable $send
     * @param callable $replay
     * @throws ServerException
     */
    public function listen(callable $send, callable $replay)
    {
        $connection = $this->connection();

        while ($conn = stream_socket_accept($connection, -1)) {
            while (!feof($conn)) {
                $message = $send();
                fwrite($conn, $message);
                switch (stream_socket_recvfrom($conn, 1024)) {
                    case self::ACCEPTED:
                        echo $replay($message).PHP_EOL;
                        break;
                    default:
                        echo 'Customer did not receive message';
                };

                //поспим несколько секунд
                $second = rand(2, 15);
                sleep($second);
            }
        }

        fclose($this->resource);
    }

    /**
     * Создаем содение с сокет
     * @return resource
     * @throws ServerException
     */
    protected function connection()
    {
        if($this->resource) {
            return $this->resource;
        }

        $resource = stream_socket_server($this->socket,$errno, $errstr);

        if(!$resource) {
            throw new ServerException($errstr, $errno);
        }

        return $this->resource = $resource;
    }
}