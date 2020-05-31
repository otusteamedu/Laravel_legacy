<?php

namespace App\Models;

use phpDocumentor\Reflection\DocBlock\Tags\Method;

/**
 * Class Advert
 *  App\Models\Advert
 *
 * @property int $id
 * @property int $user_id
 * @property int $town_id
 * @property int $division_id
 * @property string $title
 * @property int $price
 * @property string $img
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Division $division
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Message[] $messages
 * @property-read int|null $messages_count
 * @property-read \App\Models\Town $town
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Advert newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Advert newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Advert query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Advert whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Advert whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Advert whereDivisionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Advert whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Advert whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Advert wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Advert whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Advert whereTownId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Advert whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Advert whereUserId($value)
 * @mixin \Eloquent
 */

class Advert extends Model
{

    protected $fillable = [
        'title', 'price', 'content'
    ];

    public function user()
    {
        return $this->belongsTo(User::Class);
    }

    public function town()
    {
        return $this->belongsTo(Town::Class);
    }

    public function division()
    {
        return $this->belongsTo(Division::Class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
