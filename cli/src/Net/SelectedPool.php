<?php

namespace Solyaris\Net;

use Closure;
use Exception;

/**
 * Ведет учет установленных соединений на основе одного исходного прослушиваемого сокета.
 * Содержит ссылки на функции обработчики
 * Основная задача - одработать один цикл серверного прослушивания входящих соединений.
 * Класс финальный - обработчики событий добавления соединения
 *
 * Class SelectedPool
 * @package Solyaris\Net
 */
final class SelectedPool {
    /**
     * Серверный сокет, от которого происходят дочерние соединения, ведущий
     * @var Socket
     */
	private $masterSocket;
    /**
     * @var array
     */
	private $connections;
    /**
     * @var Closure function()
     */
    private $readCallback;
    /**
     * @var Closure function()
     */
    private $teakCallBack;
    /**
     * @var Closure function()
     */
    private $newCallBack;
    /**
     * @var Closure function()
     */
    private $closeCallBack;

	public function __construct(Socket $master) {
        $this->masterSocket = $master;
        $this->connections = [];

        $this->readCallback = null;
        $this->teakCallBack = null;
        $this->newCallBack = null;
        $this->closeCallBack = null;
	}
    /**
     * Обрабатывает новые данные в соединении
     *
     * @param Closure $callback
     * @return SelectedPool
     */
	public function onRead(Closure $callback) : self {
        $this->readCallback = $callback;
        return $this;
    }

    /**
     * @param SelectedConn $conn
     * @param string $data
     */
    private function Read(SelectedConn $conn, string $data) {
        if($this->readCallback instanceof Closure)
            call_user_func_array($this->readCallback, [$conn, $data]);
    }
    /**
     * Обрабатывает новую итерацию в серверном цикле
     *
     * @param Closure $callback
     * @return SelectedPool
     */
    public function onTeak(Closure $callback) : self {
        $this->teakCallBack = $callback;
        return $this;
    }

    /**
     * @param SelectedConn $conn
     */
    private function Teak(SelectedConn $conn) {
        if($this->teakCallBack instanceof Closure)
            call_user_func_array($this->teakCallBack, [$conn]);
    }
    /**
     * Обрабатывает удаление из пула
     *
     * @param Closure $callback
     * @return SelectedPool
     */
    public function onClose(Closure $callback) : self {
        $this->closeCallBack = $callback;
        return $this;
    }
    /**
     * @param SelectedConn $conn
     */
    private function Close(SelectedConn $conn) {
        if($this->closeCallBack instanceof Closure)
            call_user_func_array($this->closeCallBack, [$conn]);
    }
    /**
     * Обрабатывает добавление нового соединения
     *
     * @param Closure $callback
     * @return SelectedPool
     */
    public function onNew(Closure $callback) : self {
        $this->newCallBack = $callback;
        return $this;
    }
    /**
     * @param SelectedConn $conn
     */
    private function New(SelectedConn $conn) {
        if($this->newCallBack instanceof Closure)
            call_user_func_array($this->newCallBack, [$conn]);
    }
    /**
     * @throws SocketException
     */
    public function poll() {
        // опросим ведущий сокет на предмет нового соединения
        if($this->getMaster()->selectRead()) {
            $newSocket = $this->getMaster()->Accept();
            $conn = $this->Add($newSocket);
            $this->New($conn);
        }
        // опросим соединения по очереди, каждый раз вызывая селект только одного соединения
        $connections = $this->getConnections();
        foreach($connections as $i => $conn)
        {
            if($conn->haveInputData())
            {
                $data = $conn->getSocket()->Receive();
                // соединение разорвано
                if($data === null) {
                    $conn = $this->RemoveIndex($i);
                    $conn->getSocket()->Close();
                    $this->Close($conn);
                    continue;
                }

                $data = trim($data);
                if(strlen($data) > 0) {
                    $this->Read($conn, $data);
                }
            }
        }

        $connections = $this->getConnections();
        foreach($connections as $i => $conn)
        {
            try {
                $this->Teak($conn);
            }
            catch(Exception $e) {
                $conn = $this->RemoveIndex($i);
                $conn->getSocket()->Close();
                $this->Close($conn);
            }
        }
    }
    /**
     * @param Socket $socket
     * @return mixed|SelectedConn|null
     */
	private function Add(Socket $socket) {
        if($this->masterSocket->getId() == $socket->getId())
            return null;

        if($conn = $this->Find($socket))
            return $conn;

        $newSlave = new SelectedConn($this, $socket);
        $this->connections[] = $newSlave;
        return $newSlave;
	}

    private function Find(Socket $socket) {
        $index = $this->FindIndex($socket);
        return ($index < 0) ? null : $this->connections[$index];
    }
    
	private function FindIndex(Socket $socket) : int {
        foreach($this->connections as $i => $conn)
            if($conn->getId() == $socket->getId())
                return $i;

        return -1;        
	}
/*
    private function Remove(Socket $socket) : ?SelectedConn {
        $index = $this->FindIndex($socket);
        if($index >= 0)
            return $this->RemoveIndex($index);

        return null;
    }
*/
    private function RemoveIndex(int $index) : ?SelectedConn {
        if($index < count($this->connections)) {
            $deleted = array_splice($this->connections, $index, 1);
            return $deleted[0];
        }

        return null;
    }
    /**
     * @return Socket
     */
    private function getMaster(): Socket
    {
        return $this->masterSocket;
    }
    /**
     * @return SelectedConn[]
     */
    public function getConnections(): array {
	    return $this->connections;
    }
    /**
     *    Закрыть все соединения
     */
    public function closeAll() {
        $connections = $this->getConnections();
        foreach ($connections as $conn) {
            $conn->getSocket()->Close();
            $this->Close($conn);
        }
        $this->connections = [];
        $this->getMaster()->Close();
    }
}
