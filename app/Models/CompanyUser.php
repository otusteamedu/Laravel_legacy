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
 * @property int $id
 * @property int $company_id
 * @property int $level
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompanyUser whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompanyUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompanyUser whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompanyUser whereUserId($value)
 */
class CompanyUser extends Pivot
{
    const LEVEL_USER = 10;
    const LEVEL_MODERATOR = 20;
}
