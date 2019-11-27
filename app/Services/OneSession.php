<?php


namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

/**
 * Class OneSession
 * @package App\Services
 */
class OneSession
{
    const NAME = "one_session";

    private $request;
    private $session_id;

    public function __construct(Request $request) {
        $this->request = $request;
        $this->initialize();
    }
    /**
     * @return string
     */
    private function initialize(): string {
        $this->readId();
        if(strlen($this->getSessionId()) <= 0) {
            $this->setSessionId($this->generateSessionId());
            $this->saveId();
        }

        return $this->getSessionId();
    }
    /**
     * Получить реальный IP
     * @return string|null
     */
    public function getIp(): ?string {
        foreach ([
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR'] as $key)
        {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip);
                    // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false)
                        return $ip;
                }
            }
        }

        return null;
    }
    /**
     * @return User|null
     */
    public function geUser() {
        return $this->request->user();
    }
    /**
     * @return int
     */
    public function geUserId(): int {
        return $this->geUser() ? $this->geUser()->id : 0;
    }
    /**
     * @return string
     */
    public function getSessionId(): string {
        return $this->session_id;
    }
    /**
     * @param string $value
     * @return void
     */
    private function setSessionId(string $value) {
        $this->session_id = $value;
    }
    /**
     * @return string
     */
    private function generateSessionId(): string {
        return md5(Carbon::now()->timestamp);
    }
    public function getDomain(): string {
        $value = $this->request->getHttpHost();
        if(strpos($value, 'www.') === 0)
            $value = substr($value, 4);
        $pos = strpos($value, ':');
        if($pos > 0)
            $value = substr($value, 0, $pos);

        return $value;
    }
    /**
     * записать ID сессии
     */
    public function saveId() {
        $domain = $this->getDomain();
        $expire = Carbon::now()->addYears(1)->timestamp;

        Cookie::queue(
            Cookie::make(
                self::NAME,
                $this->getSessionId(),
                $expire,
                '/', $domain, null, false
            )
        );
    }
    /**
     * прочитать ID из куки
     * @return string
     */
    public function readId(): string {
        $this->session_id = $this->request->cookie(self::NAME, '');
        return $this->session_id;
    }
}

