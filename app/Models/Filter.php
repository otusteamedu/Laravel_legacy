<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Services\Events\Models\Filter\FilterSaved;

/**
 * App\Models\Filter
 *
 * @property int $id
 * @property int $filter_type_id event id from CINT
 * @property int $quota_id event id from CINT
 * @property string $name
 * @property string $value
 * @property string $description
 * @property string|null $created
 * @property string|null $modified
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Filter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Filter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Filter query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Filter whereCreated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Filter whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Filter whereFilterTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Filter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Filter whereModified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Filter whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Filter whereQuotaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Filter whereValue($value)
 * @mixin \Eloquent
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Filter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Filter whereUpdatedAt($value)
 */
class Filter extends BaseModel
{
//    public $timestamps = false;
    protected $fillable = [
        'name',
        'description',
        'value',
        'filter_type_id',
        'quota_id'
    ];

    protected $dispatchesEvents = [
        'saved' => FilterSaved::class,
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'created_user_id');
    }

    public function filterTypes()
    {
        return $this->belongsTo(FilterType::class, 'filter_type_id');
    }


    // Можно переопределить метод toArray() и возвращать
    // только нужное, лучше это делать в Resources
   /* public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
        ];
    }*/
}
