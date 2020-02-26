<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\System\Password_reset
 *
 * @property string $email
 * @property string $token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\Password_reset newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\Password_reset newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\Password_reset query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\Password_reset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\Password_reset whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\Password_reset whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\Password_reset whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Password_reset extends Model
{
    protected $fillable = [
        'email',
    ];

    protected $hidden = [
        'token',
    ];
}
