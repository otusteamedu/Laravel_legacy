<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ClientInformation
 *
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientInformation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientInformation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientInformation query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property string|null $material
 * @property string|null $note
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientInformation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientInformation whereMaterial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientInformation whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientInformation whereUserId($value)
 */
class ClientInformation extends Model
{
    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
