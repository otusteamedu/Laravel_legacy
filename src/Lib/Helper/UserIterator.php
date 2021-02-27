<?php

namespace Helper;

class UserIterator extends ShardIterator {
    protected $connectionName = 'user';
    protected $sql = "SELECT * FROM {{ t('data') }} WHERE id > {{ i(id) }} ORDER BY id LIMIT {{ i(limit) }}";

    public function __construct() {}

    public function current() {
        $data = $this->rows[0];
        $data += igbinary_unserialize($data['slow']) + igbinary_unserialize($data['fast']);
        return new \User\Model($data);
    }
}
