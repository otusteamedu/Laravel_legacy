<?php


namespace App\Base\Service;


use Carbon\Carbon;

class CD
{
    private $key;
    private $secondsLive;
    private $tags;

    public function __construct($key = '', int $live = 0, $tags = []) {
        $this->key = $key;
        $this->secondsLive = $live;
        $this->tags = $tags;
    }

    public function key(array $key): CD {
        $params = is_object($this) ? $this : new self();
        $params->key = $key;

        return $params;
    }

    public function tags(array $tags): CD {
        $params = is_object($this) ? $this : new self();
        $params->tags = $tags;

        return $params;
    }

    public function live(int $live): CD {
        $params = is_object($this) ? $this : new self();
        $params->secondsLive = $live;

        return $params;
    }

    public function valid() {
        return (strlen($this->key) > 0) && ($this->secondsLive > 0);
    }

    public function getTags(): array {
        if(empty($this->tags))
            return [];
        if(!is_array($this->tags))
            return [$this->tags];

        return $this->tags;
    }

    public function expired(): Carbon {
        return Carbon::now()->addSeconds($this->secondsLive);
    }

    public function getKey(): string {
        if(!is_string($this->key))
            return md5(serialize($this->key));

        return $this->key;
    }

    public function getTTL(): int {
        return $this->secondsLive;
    }
}
