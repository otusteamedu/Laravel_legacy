<?php

namespace App\Services\Telegram\Handlers;

use App\DTOs\TelegramUserDTO;
use App\Models\TelegramUser;

/**
 * Class CreateTelegramHandler
 * @package App\Services\Telegrams\Handlers
 */
class CreateTelegramUserHandler extends BaseHandler
{
    /**
     * @param array $data
     * @return TelegramUser
     */
    public function handle(array $data): TelegramUser
    {
        $DTO = TelegramUserDTO::fromArray($data);
        return $this->repository->store($DTO);
    }
}
