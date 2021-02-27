<?php

namespace Helper;

class SqlIterator implements \Iterator {
    protected $connectionName;
    protected $sql;
    protected $idField = 'id';
    protected $params = ['id' => 0, 'limit' => 50];
    protected $batch = false;

    protected $chunkSize = 50;

    /** @var \Db\Sql\Connection */
    protected $Db;
    protected $lastId = 0;
    protected $rows;
    protected $totalIndex = 0;

    public function __construct($connectionName, $sql, $idField = 'id', $params = [], $batch = false) {
        $this->connectionName = $connectionName;
        $this->sql = $sql;
        $this->idField = $idField;
        $this->batch = $batch;
        $this->params = (array)$params + ['limit' => $this->chunkSize];
    }

    public function rewind() {
        $this->Db = \Db\Sql\ConnectionManager::getConnection($this->connectionName);
        $this->params['id'] = 0;
        $this->totalIndex = 0;

        $this->nextChunk();
    }

    protected function nextChunk() {
        $this->rows = $this->Db->fetchAll($this->sql, $this->params);
        if (!$this->rows) {
            return false;
        }

        $this->params['id'] = (int)$this->rows[count($this->rows) - 1][$this->idField];
        return true;
    }

    public function valid() {
        return (bool)$this->rows;
    }

    public function current() {
        return ($this->batch ? $this->rows : $this->rows[0]);
    }

    public function key() {
        return $this->totalIndex;
    }

    public function next() {
        $this->totalIndex++;
        if (!$this->batch) {
            array_shift($this->rows);
            if ($this->rows) {
                return;
            }
        }

        $this->nextChunk();
    }
}
