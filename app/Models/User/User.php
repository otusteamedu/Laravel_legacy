<?php

namespace App\Models\User;

use App\Policies\Abilities;
use App\Policies\AuthorizationChecker;
use App\Repositories\User\Right\RightRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @package App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $icon
 * @property string $email
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property Group $group
 */
class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    public const IMAGE_FIELD = 'icon';

    public const IMAGE_PATH = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'icon', 'email',
        'password', 'group_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function isAdmin(): bool
    {
        return AuthorizationChecker::hasUserRight($this, RightRepository::CMS);
    }

}
