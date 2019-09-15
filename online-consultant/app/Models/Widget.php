<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Widget
 *
 * @property int $id
 * @property int $company_id
 * @property string $domain
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Company $company
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Widget onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereDomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Widget withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Widget withoutTrashed()
 * @mixin \Eloquent
 */
class Widget extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_id', 'domain'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
