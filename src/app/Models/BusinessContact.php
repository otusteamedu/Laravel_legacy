<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BusinessContact
 *
 * @property int $id
 * @property int $business_id
 * @property int|null $type_id
 * @property string $contact
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\Business|null $business
 * @property-read \App\Models\BusinessContactType|null $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessContact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessContact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessContact query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessContact whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessContact whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessContact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessContact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessContact whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessContact whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BusinessContact extends Model
{
    public $fillable = [
        'id',
        'business_id',
        'type_id',
        'contact',
        'created_at',
        'updated_at',
    ];

    /**
     * Business
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function business()
    {
        return $this->hasOne(Business::class);
    }

    /**
     * Business Contact Type
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function type()
    {
        return $this->hasOne(BusinessContactType::class);
    }
}
