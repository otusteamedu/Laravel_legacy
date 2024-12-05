<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrgType
 *
 * @property int $id
 * @property string $name Название
 * @property string $name_eng Название, англ
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgType whereNameEng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrgType extends Model
{
    //
}
