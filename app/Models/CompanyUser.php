<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\CompanyUser
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompanyUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompanyUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompanyUser query()
 * @mixin \Eloquent
 */
class CompanyUser extends Pivot
{
    const LEVEL_USER = 10;
    const LEVEL_MODERATOR = 20;
}
