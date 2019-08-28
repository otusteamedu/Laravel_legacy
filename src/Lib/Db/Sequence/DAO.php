<?php

namespace Db\Sequence;

class DAO {
    use \Helper\Singleton;

    const DB_NAME = 'central';

    /**
     * @var \Db\Redis\Connection
     */
    private $connection;

    protected function __construct() {
        $this->connection = \Db\Redis\ConnectionManager::getConnection(static::DB_NAME);
    }

    public function get($key) {
        return $this->connection->get($key);
    }

    public function getNext($key, $direction) {
        if ($direction === Manager::DIRECTION_INCR) {
            return $this->connection->incr($key);
        }

        if ($direction === Manager::DIRECTION_DECR) {
            return $this->connection->decr($key);
        }
    }

    public function set($key, $value) {
        return $this->connection->set($key, $value);
    }
}