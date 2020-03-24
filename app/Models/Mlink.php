<?php

namespace App\Models;


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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mlink whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mlink whereUpdatedAt($value)
 */
class Mlink extends BaseModel
{
    /*const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';*/
    //
}
