<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\FunctionAPI
 *
 * @property int $id
 * @property string $name
 * @property string $function
 * @property string|null $description
 * @property int $role_available
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FunctionAPI newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FunctionAPI newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FunctionAPI query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FunctionAPI whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FunctionAPI whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FunctionAPI whereFunction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FunctionAPI whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FunctionAPI whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FunctionAPI whereRoleAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FunctionAPI whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FunctionAPI extends Model
{
    //
}
