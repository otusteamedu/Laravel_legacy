<?php

namespace App\Services\Telegram\Repositories;

use App\DTOs\TelegramUserDTO;
use App\Models\Post;
use App\Models\TelegramUser;
use Illuminate\Support\Collection;

/**
 * Interface TelegramUserRepositoryInterface
 * @package App\Services\Telegram\Repositories
 */
interface TelegramRepositoryInterface
{
    /**
     * @param TelegramUserDTO $telegramUserDTO
     * @param TelegramUser $telegramUser
     * @return TelegramUser
     */
    public function update(TelegramUserDTO $telegramUserDTO, TelegramUser $telegramUser): TelegramUser;

    /**
     * @param TelegramUserDTO $DTO
     * @return TelegramUser
     */
    public function store(TelegramUserDTO $DTO): TelegramUser;

    /**
     * @param Post $post
     * @return Collection
     */
    public function getTelegramUsersByGroupsInPost(Post $post): Collection;
}
