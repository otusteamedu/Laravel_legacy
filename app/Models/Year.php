<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Year
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Year newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Year newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Year query()
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $name наименование года
 * @property string|null $slug название года транслитом для ЧПУ
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Year whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Year whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Year whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Year whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Year whereUpdatedAt($value)
 */
class Year extends Model
{
    //
}
