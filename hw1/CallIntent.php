<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class CallIntent extends Model
{
    public function getUrlAttribute()
    {
        $userInfo = json_decode($this->attributes['user_info'], true);

        return $userInfo['url'] ?? null;
    }

    public function getManychatUserIdAttribute()
    {
        $userInfo = json_decode($this->attributes['user_info'], true);

        return $userInfo['manychat_user_id'] ?? null;
    }

    public function getTimeZoneAttribute()
    {
        $userInfo = json_decode($this->attributes['user_info'], true);

        return $userInfo['timezone'] ?? null;
    }

    /**
     * Согласно принципу DRY часто используемые куски кода выделаяем в методы
     */
    public function getTopCall()
    {
        if (!$this->isComplete()) {
            return $this->calculateTopCall();
        }

        $topCall = $this->topCall;

        if (!$topCall) {
            $topCall = $this->calculateTopCall();
        }

        return $topCall;
    }

    public function getInnerCalls()
    {
        $innerCalls = $this->innerCalls;

        if (!$innerCalls) {
            $innerCalls = Call::whereRaw("SUBSTRING(session_id, 1, 36) = '$this->queue_id'")->get();
        }

        return $innerCalls;
    }

    /**
     * DRY
     */
    public static function generateQueueId()
    {
        return sprintf('CRCI%s', md5(time()));
    }

    /**
     * DRY и нарушение DIP, нужна абстракция для получения настроек
     */
    public static function makeInstantCallIntent(Rocket $rocket, $clientPhone, $trigger = false, $userData = []) {}

    public static function makeScheduledCallIntent(Rocket $rocket, $clientPhone, $day, $time, $trigger = false, $userRequestData = []) {}
}
