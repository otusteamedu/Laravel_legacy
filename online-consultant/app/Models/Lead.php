<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Lead
 *
 * @property int $id
 * @property int $company_id
 * @property string $name
 * @property string $email
 * @property array|null $info
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Company $company
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Lead onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Lead withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Lead withoutTrashed()
 * @mixin \Eloquent
 */
class Lead extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_id', 'name', 'email', 'info'
    ];

    protected $casts = [
        'info' => 'array'
    ];

    /**
     * Get the company this lead belongs to
     *
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
