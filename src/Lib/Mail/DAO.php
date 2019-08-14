<?php

/**
 * Почтовый DAO
 */

namespace Mail;

class DAO {
    use \Helper\Singleton;

    const DEFAULT_QUEUE_QUERY_COUNT = 10;
    const REDIS_INSTANCE = 'mailQueue';

    const SENDMAIL_PARAMS = '-fsupport@project.com';

    protected $redisQueueKeyTpl = 'mail_queue:%d';

    protected static $defaultHeaders = [
        'MIME-Version: 1.0',
        'Content-type: text/html; charset=UTF-8',
        'From: Project.com notifications <robot@project.com>',
        'Reply-To: Project.com support <support@project.com>',
        'X-Mailer: PHP/6.0.0alpha7',
        'Content-Transfer-Encoding: Quoted-printable',
    ];

    const MESSAGE_ID_HEADER_TPL = 'Message-ID: <%d.%d.%s>';

    const LIST_UNSUBSCRIBE_HEADER_TPL = 'List-Unsubscribe: <https://%s/unsubscribe/%d/%s/%d/>, <mailto:support@project.com?subject=Unsubscribe%%20me>';

    /** @var \Db\Redis\Connection */
    protected $Redis;

    protected function getRedis() {
        if (!$this->Redis) {
            $this->Redis = \Db\Redis\ConnectionManager::getConnection(self::REDIS_INSTANCE);
        }
        return $this->Redis;
    }

    public function getQueueKey($type) {
        return sprintf($this->redisQueueKeyTpl, $type);
    }

    public function addToMailQueue($type, $data) {
        $this->getRedis()->lPush($this->getQueueKey($type), igbinary_serialize($data));
    }

    /**
     * @param $type
     * @throws \RuntimeException
     * @throws \Db\Redis\ConnectionException
     * @return array
     */
    public function getNextQueued($type) {
        $RConn = $this->getRedis();
        $key = $this->getQueueKey($type);

        while(true) {
            pcntl_signal_dispatch();
            $data = $RConn->brPop($key);
            if (!empty($data) && is_array($data) && array_key_exists(1, $data)) {
                return igbinary_unserialize($data[1]);
            }
        }
        throw new \RuntimeException('This is unreacheable! WTF?');
    }

    public function encodeMailHeader($header) {
        return '=?utf-8?B?' . base64_encode($header) . '?=';
    }

    public function encodeMailBody($text) {
        return quoted_printable_encode($text);
    }

    protected function mail($email, $subject, $html, $header) {
        return mail($email, $subject, $html, $header, self::SENDMAIL_PARAMS);
    }

    /**
     * @param $userId
     * @param $unsubscribeHash
     * @param $email
     * @param $subject
     * @param $html
     * @param int $subscriptionType
     * @return bool
     */
    public function actuallySendMail($userId, $unsubscribeHash, $email, $subject, $html, $subscriptionType) {
        $headers = self::$defaultHeaders;

        $messageIdHeader = sprintf(self::MESSAGE_ID_HEADER_TPL, mt_rand(1000, 9999), time(), $email);
        $headers[] = $messageIdHeader;

        if ($subscriptionType) {
            $listUnsubscribeHeader = sprintf(self::LIST_UNSUBSCRIBE_HEADER_TPL, PROJECT_HOST, $userId, $unsubscribeHash, $subscriptionType);
            $headers[] = $listUnsubscribeHeader;
        }

        $headerString = implode("\r\n", $headers) . "\r\n";

        $encodedSubject = $this->encodeMailHeader($subject);
        $encodedHtml = $this->encodeMailBody($html);

        $result = $this->mail($email, $encodedSubject, $encodedHtml, $headerString);
        $resultText = ($result ? 'Mail sent' : 'Failed to send mail');
        \Project\Logger::debugText("$resultText to $email for user $userId, with subject '$subject'");
        return $result;
    }

    public function setRedisClientName($name) {
        $this->getRedis()->clientSetname($name);
    }
}
