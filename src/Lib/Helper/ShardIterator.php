<?php

namespace Helper;

class ShardIterator extends SqlIterator {
    protected $spots;
    protected $reverse = false;

    /** @var \Db\Sql\ShardConnection */
    protected $Db;

    public function __construct($connectionName, $sql, $idField = 'id', $params = [], $reverse) {
        $this->reverse = $reverse;
        parent::__construct($connectionName, $sql, $idField, $params, false);
    }

    public function rewind() {
        $this->params['id'] = 0;
        $this->totalIndex = 0;
        $this->batch = false;

        $this->spots = array_keys(\Db\Shard\Manager::getSpotmap($this->connectionName));
        if ($this->reverse) {
            rsort($this->spots, SORT_NUMERIC);
        } else {
            sort($this->spots, SORT_NUMERIC);
        }
        $this->nextSpot();
        $this->nextChunk();
    }

    protected function nextSpot() {
        if (!$this->spots) {
            $this->Db = null;
            return false;
        }

        $spot = array_shift($this->spots);
        $this->Db = \Db\Sql\ConnectionManager::getShardConnection($this->connectionName, $spot);
        $this->rows = [];
        return true;
    }

    protected function nextChunk() {
        while (!parent::nextChunk() and $this->nextSpot()) {}
        return (bool)$this->rows;
    }
}
