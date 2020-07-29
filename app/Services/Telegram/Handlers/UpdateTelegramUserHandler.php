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
     * @param array $data
     * @param TelegramUser $telegramUser
     * @return TelegramUser
     */
    public function handle(array $data, Telegram $telegramUser): TelegramUser
    {
        $DTO = TelegramUserDTO::fromArray(array_merge(
            $data,
            [TelegramUserDTO::USER_ID => $telegramUser->user_id]
        ));
        $groupsId = $data['groups'];
        $telegramUser = $this->repository->update($DTO, $telegramUser);

        $telegramUser->groups()->sync($groupsId);

        return $telegramUser;
    }
}
