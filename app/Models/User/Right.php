<?php

namespace App\Models\User;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Right
 * @package App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $right
 * @property Collection $groups
 */
class Right extends BaseModel
{
    /** @inheritDoc  */
    protected $table = 'rights';

    /** @inheritDoc */
    public $timestamps = false;

    /** @inheritDoc  */
    protected $fillable = [
        'name', 'right',
    ];

    /**
     * @return BelongsToMany
     */
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(
            Group::class,
            'group_right',
            'right_id',
            'group_id'
        );
    }
}
