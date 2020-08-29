<?php

namespace App\Services\Telegram\Statuses;

use App\Models\TelegramUser;
use Illuminate\Support\Facades\Cache;

/**
 * Class TelegramUserStatus
 * @package App\Services\Telegram\Statuses
 */
class TelegramUserStatus
{
    const START_REGISTRATION = 1;
    const SET_GROUP = 2;
    const SET_SCHEDULE_DATE = 3;

    public static function getKey(TelegramUser $telegramUser): string
    {
        return 'telegram_user_' . $telegramUser->id;
    }

    /**
     * @param TelegramUser $telegramUser
     * @param int $status
     * @param float|int $sec
     */
    public function setStatus(TelegramUser $telegramUser, int $status, int $sec = 60*60): void
    {
        Cache::put(static::getKey($telegramUser), $status, $sec);
    }

    /**
     * @param TelegramUser $telegramUser
     * @return int|null
     */
    public function getAndClearStatus(TelegramUser $telegramUser): ?int
    {
        return Cache::pull(static::getKey($telegramUser));
    }
}
