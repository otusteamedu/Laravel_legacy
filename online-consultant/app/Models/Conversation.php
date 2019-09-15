<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Conversation
 *
 * @property int $id
 * @property int $company_id
 * @property int $widget_id
 * @property int $manager_id
 * @property int $lead_id
 * @property string $text
 * @property array|null $info
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Company $company
 * @property-read \App\Models\Lead $lead
 * @property-read \App\Models\User $manager
 * @property-read \App\Models\Widget $widget
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Conversation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Conversation newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Conversation onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Conversation query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Conversation whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Conversation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Conversation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Conversation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Conversation whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Conversation whereLeadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Conversation whereManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Conversation whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Conversation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Conversation whereWidgetId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Conversation withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Conversation withoutTrashed()
 * @mixin \Eloquent
 */
class Conversation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_id', 'widget_id', 'manager_id', 'lead_id', 'text', 'info'
    ];

    protected $casts = [
        'info' => 'array'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function widget(): BelongsTo
    {
        return $this->belongsTo(Widget::class);
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }
}
