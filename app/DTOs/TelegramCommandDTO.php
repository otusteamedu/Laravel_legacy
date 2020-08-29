<?php

namespace App\DTOs;

use App\Models\TelegramUser;

/**
 * Class TelegramCommandDTO
 * @package App\DTOs
 */
class TelegramCommandDTO implements DTOInterface
{
    const TELEGRAM_MESSAGE_DTO = 'telegram_message';
    const TELEGRAM_USER = 'telegram_user';
    /**
     * @var TelegramMessageDTO
     */
    private $telegramMessageDTO;
    /**
     * @var TelegramUser
     */
    private $telegramUser;

    /**
     * IdDTO constructor.
     * @param TelegramMessageDTO $telegramMessageDTO
     * @param TelegramUser $telegramUser
     */
    private function __construct(TelegramMessageDTO $telegramMessageDTO, TelegramUser $telegramUser)
    {
        $this->telegramMessageDTO = $telegramMessageDTO;
        $this->telegramUser = $telegramUser;
    }

    /**
     * @param array $data
     * @return DTOInterface
     */
    public static function fromArray(array $data): DTOInterface
    {
        return new static($data[static::TELEGRAM_MESSAGE_DTO], $data[static::TELEGRAM_USER]);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            static::TELEGRAM_MESSAGE_DTO => $this->telegramMessageDTO,
            static::TELEGRAM_USER => $this->telegramUser,
        ];
    }
}
