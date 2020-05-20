<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

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
 */
class ProjectUser extends Model
{
    use SoftDeletes;

    protected $table = 'project_user';
}
