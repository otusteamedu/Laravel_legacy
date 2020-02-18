<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\UsersPrivacyPolicies
 *
 * @property int $id
 * @property int $user_id
 * @property int $permission_to_show_email
 * @property int $permission_to_show_phone_number
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsersPrivacyPolicies newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsersPrivacyPolicies newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsersPrivacyPolicies query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsersPrivacyPolicies whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsersPrivacyPolicies wherePermissionToShowEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsersPrivacyPolicies wherePermissionToShowPhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsersPrivacyPolicies whereUserId($value)
 * @mixin \Eloquent
 */
class UsersPrivacyPolicies extends Model
{
    //
}
