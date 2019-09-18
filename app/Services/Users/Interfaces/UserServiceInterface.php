<?php

declare(strict_types=1);

namespace App\Services\Users\Interfaces;

use App\Models\User;
use App\Models\Workout;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface UserServiceInterface
 */
interface UserServiceInterface extends UserRepositoryInterface
{
    // @todo Добавить методы для связанных сущностей
}
