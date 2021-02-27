<?php

namespace Background;

/**
 * @property string $beginDate
 * @property string $endDate
 * @property int[] $origins
 * @property bool $writeHeader
 * @property string $error
 * @property string $fileUrl
 */
class CsvUsersTask extends AbstractTask {
    protected static $attr = [
        '$default' => self::ATTR_TYPE_INT,
        'id',
        'userId',
        'type',
        'status',
        'openTime',
        'data' => [
            'beginDate' => self::ATTR_TYPE_RAW,
            'endDate' => self::ATTR_TYPE_RAW,
            'origins' => self::ATTR_TYPE_ARRAY,
            'writeHeader' => self::ATTR_TYPE_BOOL,
            'error' => self::ATTR_TYPE_RAW,
            'fileUrl' => self::ATTR_TYPE_RAW,
        ],
    ];

    protected $lockName = 'task-users-csv-%d';

    protected static $taskType = Manager::TYPE_CSV_USERS;
    protected $expirationPeriod = 864000; // 10 суток

    const TEMP_FILE_PREFIX = 'csv-users_';
    protected $columns = ['id', 'name', 'origin', 'loginType', 'registrationDate', 'phone', 'email', 'country', 'city', 'cityId', 'company', 'requests', 'vehicles', 'isManager'];

    protected $originLabels = [
        \User\Model::ORIGIN_USER => 'реальный',
        \User\Model::ORIGIN_MANAGER => 'телефонный',
        \User\Model::ORIGIN_ANON => 'аноним',
    ];

    public function rules() {
        return array_merge(parent::rules(), [
            [['beginDate', 'endDate', 'origins', 'writeHeader'], 'safe', 'on' => 'insert'],
            [['status', 'error', 'fileUrl'], 'safe', 'on' => 'update'],
            [['beginDate', 'origins'], 'required'],
            [['beginDate', 'endDate'], 'date', 'max' => time()],
            ['endDate', 'default', 'value' => date('d.m.Y')],
            ['origins', 'array', 'min' => 1],
            ['origins', ['int'], 'min' => 0],
            ['writeHeader', 'bool'],
        ]);
    }


    public function run() {
        if ($this->status <> self::STATUS_OPEN) {
            return false;
        }

        $tempName = \File\Manager::createTmpFile(static::TEMP_FILE_PREFIX);
        try {
            $this->writeFile($tempName);
            $File = $this->createFileRecord();
            $this->moveFile($File, $tempName);
            $this->fileUrl = \File\Manager::getRandomStaticFileUrl(null, $File);
            if ($this->finish()) {
                $this->save(false);
                $this->release();
            }
            return true;
        } catch (\Exception $E) {
            unlink($tempName);
            if ($this->setError()) {
                $this->error = $E->getMessage();
                $this->save(false);
                $this->release();
            }
            throw $E;
        }
    }

    protected function writeFile($fileName) {
        $companyIndex = $this->getCompanyIndex();
        $origins = array_flip($this->origins);
        $beginDate = strtotime($this->beginDate);
        $endDate = strtotime($this->endDate . ' 23:59:59');

        $Csv = new \Helper\CsvWriter($this->columns);
        $file = fopen($fileName, 'wb');
        if (!$file) {
            throw new \RuntimeException('cannot write temp file ' . $fileName);
        }

        if ($this->writeHeader) {
            fwrite($file, $Csv->formatColumns());
        }

        // МНОГО КОДА

        fclose($file);
    }

    /**
     * @return \File\TempStaticFile
     */
    protected function createFileRecord() {
        $origins = implode('', $this->origins);
        $header = ($this->writeHeader ? '_h' : '');
        $baseName = "users_{$this->beginDate}_{$this->endDate}_$origins{$header}.csv";
        $File = \File\Manager::createTempStaticFile($baseName, \File\Manager::TYPE_CSV_USERS, $this->userId, $this->id, $this->expirationPeriod, \File\TempStaticFile::STATUS_ACTIVE);

        return $File;
    }

    /**
     * @param \File\TempStaticFile $File
     * @param string $fileName
     */
    protected function moveFile($File, $fileName) {
        \File\Manager::putFile(null, $File->name, $fileName);
        \File\Manager::activateTempFiles($File->id);
        unlink($fileName);
    }

    protected function getLabel($value, $labels) {
        return (isset($labels[$value]) ? $labels[$value] : $value);
    }

    public function delete() {
        \File\Manager::deleteMultipleTempFiles(null, \File\Manager::getTempFilesByTaskId($this->id));
        parent::delete();
    }
}
