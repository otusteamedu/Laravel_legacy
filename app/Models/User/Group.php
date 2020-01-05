<?php

namespace App\Models\User;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Group
 * @package App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property Collection $users
 * @property Collection $rights
 */
class Group extends BaseModel
{
    /** @inheritDoc  */
    protected $table = 'groups';

    /** @inheritDoc  */
    protected $fillable = [
        'name',
    ];

    /**
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function rights(): BelongsToMany
    {
        return $this->belongsToMany(
            Right::class,
            'group_right',
            'group_id',
            'right_id'
        );
    }
}
