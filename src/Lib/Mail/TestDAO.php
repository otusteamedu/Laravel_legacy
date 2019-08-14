<?php
/**
 * Тестовый почтовый DAO для dev-окружения
 */

namespace Mail;

class TestDAO extends DAO {
    protected $redisQueueKeyTpl = 'test_mail_queue:%d';
    protected static $tempQueueKeyTpl = 'test_mail_queue%s:%%d';
    protected static $sentLogKey = 'test_mail_sent';
    protected $timeBase;
    protected $mailDir;

    protected static $mailTypes = [
        'registration'          => \Mail\Manager::TYPE_REGISTRATION,
        'password recovery'     => \Mail\Manager::TYPE_PASSWORD_RECOVERY,
        'new message'           => \Mail\Manager::TYPE_NEW_MESSAGE,
        'mail confirmation'     => \Mail\Manager::TYPE_MAIL_CONFIRMATION,
        'new password'          => \Mail\Manager::TYPE_NEW_PASSWORD,
        'feedback'              => \Mail\Manager::TYPE_FEEDBACK,
        'service registration'  => \Mail\Manager::TYPE_SERVICE_REGISTRATION,
        'service request'       => \Mail\Manager::TYPE_SERVICE_REQUEST,
        'request expire'        => \Mail\Manager::TYPE_REQUEST_EXPIRE,
        'request closed'        => \Mail\Manager::TYPE_REQUEST_CLOSED,
        'company confirmed'     => \Mail\Manager::TYPE_COMPANY_CONFIRMED,
    ];

    protected function __construct() {
        $this->timeBase = strtotime('2015-01-01');
        $this->mailDir = PROJECT_PATH . '/mail/';
        umask(0002);
    }

    public function encodeMailHeader($header) {
        return $header;
    }

    public function encodeMailBody($text) {
        return $text;
    }

    protected function mail($email, $subject, $html, $header) {
        $header = "To: $email\r\nSubject: $subject\r\n$header\r\n";
        if (strpos($html, '<body>')) {
            $html = str_replace('<body>', "<body><!-- headers --><pre>$header</pre>", $html);
        } else {
            $html = "<!-- headers --><pre>$header</pre>" . $html;
        }
        $time = (int)((microtime(true) - $this->timeBase) * 1000000);
        if (!is_dir($this->mailDir) && @mkdir($this->mailDir, 0775) && !is_dir($this->mailDir)) {
            \Project\Logger::logText(\Project\Logger::LOGFILE_APOCALYPSE, "could not create mail folder!");
            return false;
        }
        $name = $this->mailDir . substr(str_repeat('0', 16) . $time, -16);
        return (bool)file_put_contents($name, $html);
    }

    public function actuallySendMail($userId, $unsubscribeHash, $email, $subject, $html) {
        parent::actuallySendMail($userId, $unsubscribeHash, $email, $subject, $html, 0);
        $data = ['userId' => $userId, 'subject' => $subject, 'email' => $email];
        $this->getRedis()->rPush(static::$sentLogKey, json_encode($data));
    }

    public function clearSentLog() {
        $this->getRedis()->del(static::$sentLogKey);
    }

    public function getSentLog() {
        $result = $this->getRedis()->lRange(static::$sentLogKey, 0, -1);
        foreach ($result as &$p) {
            $p = json_decode($p, true);
        }
        return $result;
    }

    public function listMessages() {
        $result = [];
        $names = array_reverse(glob($this->mailDir . '*'));
        foreach ($names as $name) {
            $html = file_get_contents($name);
            if (!preg_match('#<!-- headers --><pre>(.+?)</pre>#s', $html, $matches)) {
                continue;
            }

            $entry = [];
            $headers = explode("\r\n", trim($matches[1]));
            foreach ($headers as $header) {
                $header = explode(': ', $header, 2);
                $entry[$header[0]] = trim($header[1]);
            }

            $result[basename($name)] = $entry;
        }

        return $result;
    }

    public function getMessage($name) {
        $name = $this->mailDir . $name;
        if (is_file($name)) {
            return file_get_contents($name);
        } else {
            return null;
        }
    }

    public function clear() {
        $names = glob($this->mailDir . '*', GLOB_NOSORT);
        foreach ($names as $name) {
            unlink($name);
        }
    }

    public function getQueueLengths() {
        $result = [];
        $types = Manager::getInstance()->getQueueTypes();
        $Redis = $this->getRedis();
        foreach ($types as $type) {
            $len = $Redis->lLen($this->getQueueKey($type));
            if ($len) {
                $result[$type] = $len;
            }
        }
        return $result;
    }

    public function clearQueue($type = null) {
        if ($type) {
            $keys = $this->getQueueKey($type);
        } else {
            $keys = [];
            foreach (Manager::getInstance()->getQueueTypes() as $type) {
                $keys[] = $this->getQueueKey($type);
            }
        }
        $this->getRedis()->del($keys);
    }

    public function listQueuedMessages($queueType) {
        $key = $this->getQueueKey($queueType);
        $queue = $this->getRedis()->lRange($key, 0, -1);
        $result = [];
        foreach ($queue as $entry) {
            $result[] = igbinary_unserialize($entry);
        }
        return $result;
    }
}