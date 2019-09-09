<?php

namespace Solyaris\Net;

use Exception;

/**
 * Class Socket
 * @package App\Net
 */
class Socket
{
    /**
     * @var resource
     */
    private $handle = null;
    /**
     * Socket constructor.
     * @param $handle
     */
    private function __construct($handle) {
        $this->handle = $handle;
    }
    /**
     * @return int
     */
    public function getId() : int {
        return (int) $this->handle;
    }
    /**
     * @param int $domain
     * @return resource
     * @throws SocketException
     */
    private static function createResource(int $domain = AF_INET) {
        if(!in_array($domain, [AF_UNIX, AF_INET, AF_INET6]))
            $domain = AF_UNIX;
        $protocol = (AF_UNIX == $domain) ? 0 : getprotobyname('tcp');
        $handle = @socket_create ( $domain , SOCK_STREAM , $protocol);
        if(!is_resource($handle))
            throw new SocketException();

        return $handle;
    }

    /**
     * @param $address
     * @return string
     * @throws Exception
     */
    public static function hostToIP4($address) {
        if( !preg_match('/^\d+\.\d+\.\d+\.\d+$/', $address) ) {
            $host = @gethostbyname($address);
            if ($host == $address)
                throw new Exception($address . ": неверный адрес");
        }
        else
            $host = $address;

        return $host;
    }

    /**
     * @param string $address
     * @param int $domain
     * @param int $port
     * @return Socket
     * @throws SocketException
     * @throws Exception
     */
    public static function createClient(string $address, int $domain = AF_UNIX, int $port = 0): self
    {
        $handle = self::createResource($domain);

        $bResult = false;
        if(AF_UNIX == $domain) {
            $bResult = @socket_connect($handle, $address);
        }
        elseif(AF_INET == $domain) {
            $bResult = @socket_connect($handle, self::hostToIP4($address), $port);
        }

        if(!$bResult)
            throw new SocketException();

        // @socket_set_nonblock($handle);

        return new self($handle);
    }

    /**
     * @param string $address
     * @param int $domain
     * @param int $port
     * @return Socket
     * @throws SocketException
     * @throws Exception
     */
    public static function createServer(string $address, int $domain = AF_UNIX, int $port = 0) {
        $handle = self::createResource($domain);

        $bResult = false;
        if(AF_UNIX == $domain) {
            $bResult = @socket_bind($handle, $address);
        }
        elseif(AF_INET == $domain) {
            $bResult = @socket_bind($handle, self::hostToIP4($address), $port);
        }
        if(!$bResult)
            throw new SocketException();

        if(!@socket_listen($handle,5))
            throw new SocketException();

        @socket_set_nonblock($handle);

        return self::FromHandle($handle);
    }
    /**
     * @return Socket
     * @throws SocketException
     */
    public function Accept(): self {
        if(($handle = @socket_accept($this->handle)) === false)
            throw new SocketException();

        return self::FromHandle($handle);
    }

    /**
     * @param int $tv_sec
     * @return bool
     * @throws SocketException
     */
    public function selectRead($tv_sec = 0): bool
    {
        $tv_usec = $tv_sec === null ? null : (($tv_sec - floor($tv_sec)) * 1000000);

        $read = array( $this->handle );
        $x = NULL;
        $changed = @socket_select($read, $x, $x, $tv_sec, $tv_usec);
        if ($changed === false)
            throw new SocketException();

        return ($changed > 0);
    }

    /**
     * Записывает все сообщение. Если надо дробит по частям
     *
     * @param string $data
     * @throws SocketException
     */
    public function Send(string $data)
    {
        if(!is_resource($this->handle))
            throw new SocketException();
        $length = strlen($data);
        while (true) {
            $sent = @socket_write($this->handle , $data, $length);
            if ($sent === false)
                throw new SocketException();

            // Check if the entire message has been sented
            if ($sent < $length) {
                // If not sent the entire message.
                // Get the part of the message that has not yet been sented as message
                $data = substr($data , $sent);
                // Get the length of the not sented part
                $length -= $sent;
            } else {
                break;
            }
        }
    }

    /**
     * Читает все сообщение
     *
     * @return string
     * @throws SocketException
     */
    public function Receive(): ?string
    {
        if(!is_resource($this->handle))
            throw new SocketException();

        $data = "";
        do {
            $buffer = @socket_read($this->handle, 1024, PHP_BINARY_READ);
            $bytes = strlen($buffer);
            if ($buffer === false)
                return null;
            $data .= $buffer;
            break;
        }
        while($bytes > 0);

        return $data;
    }

    public function Close() {
        if(!is_null($this->getHandle()))
            socket_close($this->getHandle());
        $this->handle = null;
    }

    /**
     * @return resource
     */
    public function getHandle() {
        return $this->handle;
    }

    public static function FromHandle($handle): self {

        return new self($handle);
    }
}