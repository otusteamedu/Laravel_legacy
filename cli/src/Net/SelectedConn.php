<?php

namespace Solyaris\Net;

/**
 * Прослушиваемое соединение.
 * Содержит прослушиваемый сокет и какие-то дополнительные данные
 *
 * Class SelectedConn
 * @package Solyaris\Net
 */
class SelectedConn {
    /**
     * @var Socket
     */
    private $socket;
    /**
     * @var SelectedPool
     */
    private $manager;
    /**
     * @var Socket
     */
    private $attributes;
    /**
     * SelectedConn constructor.
     * @param SelectedPool $manager
     * @param Socket $socket
     */
    public function __construct(SelectedPool $manager, Socket $socket)
    {
        $this->manager = $manager;
        $this->socket = $socket;
        $this->attributes = [];
    }

    private function getManager() : SelectedPool {
        return $this->manager;
    }
    /**
     * @return Socket
     */
    public function getSocket() : Socket {
        return $this->socket;
    }
    /**
     * @return int
     */
    public function getId(): int {
        return $this->getSocket()->getId();
    }
    /**
     * @return bool
     * @throws SocketException
     */
    public function haveInputData(): bool {
        return $this->getSocket()->selectRead();
    }
    /**
     * @param string $name
     * @param string|null $value
     * @return SelectedConn
     */
    public function set(string $name, string $value = null): self {
        if(is_null($value)) {
            if($this->has($name))
                unset($this->attributes[$name]);
        }
        else
            $this->attributes[$name] = $value;

        return $this;
    }
    /**
     * @param string $name
     * @return string
     */
    public function get(string $name): string {
        return $this->has($name) ? $this->attributes[$name] : '';
    }
    /**
     * @param string $name
     * @return string
     */
    public function has(string $name): bool {
        return array_key_exists($name, $this->attributes);
    }
}