<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Tariff
 *
 * @property int $id
 * @property string $name
 * @property array $condition
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tariff newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tariff newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tariff query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tariff whereCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tariff whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tariff whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tariff whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tariff whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Tariff extends BaseModel
{
    public $entityName = 'tariff';

    protected $casts = [
        'condition' => 'array'
    ];

    protected $fillable = [
        'name',
        'condition',
    ];
}
