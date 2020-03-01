<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\System\PasswordReset
 *
 * @property string $email
 * @property string $token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\PasswordReset newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\PasswordReset newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\PasswordReset query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\PasswordReset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\PasswordReset whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\PasswordReset whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\PasswordReset whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PasswordReset extends Model
{
    protected $fillable = [
        'email',
    ];

    protected $hidden = [
        'token',
    ];
}
