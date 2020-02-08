<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\UserGroupRight
 *
 * @property int $id
 * @property string $code
 * @property string|null $description
 * @property int $group_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\UserGroup $group
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGroupRight newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGroupRight newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGroupRight query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGroupRight whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGroupRight whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGroupRight whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGroupRight whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGroupRight whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGroupRight whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserGroupRight extends BaseModel
{
    public function group(): BelongsTo
    {
        return $this->belongsTo(UserGroup::class);
    }
}
