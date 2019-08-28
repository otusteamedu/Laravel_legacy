<?php

namespace Background;

/**
 * @property int $id
 * @property int $userId
 * @property int $type
 * @property int $status
 * @property int $openTime
 */
abstract class AbstractTask extends \Project\Model {
    const STATUS_OPEN = 1;
    const STATUS_DONE = 2;
    const STATUS_ERROR = 3;
    const STATUS_CANCEL = 4;

    protected static $attr = [
        '$default' => self::ATTR_TYPE_INT,
        'id',
        'userId',
        'type',
        'status',
        'openTime',
        'data' => [],
    ];

    protected static $taskType;

    protected static $shardKey = 'userId';
    protected static $sequence = \Db\Sequence\Central_Manager::TYPE_BACKGROUND_TASK;

    protected $lockName = '';

    /**
     * @return bool выполнено или нет
     */
    abstract public function run();

    public function delete() {
        if (!$this->isNew) {
            Manager::deleteTasksByUserIdNIds($this->userId, $this->id);
        }
    }

    protected function getLock() {
        $id = $this->id;
        if (!$this->lockName or !$id) {
            return null;
        }

        return \Helper\Locker::getInstance()->lock($this->lockName, $id);
    }

    protected function insertData(array $packedData) {
        return DAO::createTask($packedData);
    }

    protected function updateData(array $key, array $packedData) {
        return DAO::updateTask($key, $packedData);
    }

    protected function selectData(array $key) {
        return DAO::selectTask($key);
    }


    public function rules() {
        return [
            ['*', 'unsafe'],
            ['userId', 'safe', 'on' => 'insert'],
            ['userId', 'required'],
            ['userId', 'int', 'min' => 1],
            ['type', 'default', 'value' => static::$taskType],
            ['type', 'required'],
            ['type', 'in', 'list' => [static::$taskType]],
            ['openTime', 'default', 'value' => time()],
            ['status', 'default', 'value' => self::STATUS_OPEN],
        ];
    }

    public function changeStatus($status) {
        if (!$this->lockNLoad() or $this->status <> self::STATUS_OPEN) {
            $this->unlock();
            if ($this->status == self::STATUS_CANCEL) {
                Manager::deleteTasksByUserIdNIds($this->userId, $this->id);
            }
            return false;
        }

        $this->status = $status;
        return true;
    }

    public function finish() {
        return $this->changeStatus(self::STATUS_DONE);
    }

    public function cancel() {
        return $this->changeStatus(self::STATUS_CANCEL);
    }

    public function setError() {
        return $this->changeStatus(self::STATUS_ERROR);
    }

    public function release() {
        DAO::releaseTask($this->id);
    }
}
