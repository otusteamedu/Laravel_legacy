<?php

namespace App\Services\Telegram\Repositories;

use App\DTOs\TelegramUserDTO;
use App\Models\Post;
use App\Models\TelegramUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

/**
 * Class EloquentTelegramUserRepository
 * @package App\Services\TelegramUser\Repositories
 */
class EloquentTelegramRepository implements TelegramRepositoryInterface
{
    /**
     * @param TelegramUserDTO $telegramUserDTO
     * @param TelegramUser $telegramUser
     * @return TelegramUser
     */
    public function update(TelegramUserDTO $telegramUserDTO, TelegramUser $telegramUser): TelegramUser
    {
        $telegramUser->update($telegramUserDTO->toArray());

        return $telegramUser;
    }

    /**
     * @param TelegramUserDTO $DTO
     * @return TelegramUser
     */
    public function store(TelegramUserDTO $DTO): TelegramUser
    {
        return TelegramUser::create($DTO->toArray());
    }

    /**
     * @param Post $post
     * @return Collection
     */
    public function getTelegramUsersByGroupsInPost(Post $post): Collection
    {
        return TelegramUser::whereHas('user.students.groups', function (Builder $builder) use ($post): void {
            $builder->whereIn('id', $post->groups->pluck('id'));
        })->get();
    }
}
