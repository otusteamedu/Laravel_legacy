<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Segment
 *
 * @property int $id
 * @property string $name
 * @property array $condition
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Segment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Segment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Segment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Segment whereCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Segment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Segment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Segment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Segment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Segment extends BaseModel
{
    public $entityName = 'segment';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'condition' => 'array'
    ];

    protected $fillable = [
        'name',
        'condition',
    ];
}
