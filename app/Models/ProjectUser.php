<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use Watson\Rememberable\Rememberable;

/**
 * App\Models\ProjectUser
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectUser newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProjectUser onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectUser query()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProjectUser withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProjectUser withoutTrashed()
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property int $project_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectUser whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectUser whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectUser whereUserId($value)
 */
class ProjectUser extends Pivot
{
    use SoftDeletes, Rememberable;
}
