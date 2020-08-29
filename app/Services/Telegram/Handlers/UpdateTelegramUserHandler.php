<?php

namespace App\Services\Telegram\Handlers;

use App\DTOs\TelegramUserDTO;
use App\Models\TelegramUser;

/**
 * Class UpdateTelegramHandler
 * @package App\Services\Telegram\Handlers
 */
class UpdateTelegramUserHandler extends BaseHandler
{
    /**
     * @param TelegramUserDTO $telegramUserDTO
     * @param TelegramUser $telegramUser
     * @return TelegramUser
     */
    public function handle(TelegramUserDTO $telegramUserDTO, TelegramUser $telegramUser): TelegramUser
    {
        $this->repository->update($telegramUserDTO, $telegramUser);

        return $telegramUser;
    }
}
