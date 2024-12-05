<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrgGroup
 *
 * @property int $id
 * @property string $name Название
 * @property string $name_eng Название, англ
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgGroup whereNameEng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgGroup whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrgGroup extends Model
{
    //
}
