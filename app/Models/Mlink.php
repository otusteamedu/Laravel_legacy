<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Mlink
 *
 * @property int $id
 * @property int $mpoll_id
 * @property string|null $link
 * @property int|null $user_id
 * @property int|null $status
 * @property string|null $user_ip
 * @property string|null $created
 * @property string|null $modified
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mlink newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mlink newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mlink query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mlink whereCreated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mlink whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mlink whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mlink whereModified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mlink whereMpollId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mlink whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mlink whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mlink whereUserIp($value)
 * @mixin \Eloquent
 */
class Mlink extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    //
}
