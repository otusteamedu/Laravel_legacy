<?php

namespace App\Models;

use App\Services\Students\StudentService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Student
 *
 * @property int $id
 * @property int $id_number
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereIdNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Chat[] $chat
 * @property-read int|null $chat_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Consultation[] $consultations
 * @property-read int|null $consultations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[] $group
 * @property-read int|null $group_count
 * @property-read \App\Models\User $user
 */
class Student extends CacheModel
{
    /**
     * @var string
     */
    protected $rememberCacheTag = StudentService::CACHE_TAG;

    /** @var array  */
    protected $fillable = [
        'id_number',
        'user_id'
    ];

    /**
     * @param Builder $builder
     * @param int $idNumber
     * @return Builder
     */
    public function scopeIdNumber(Builder $builder, int $idNumber): Builder
    {
        return $builder->where('id_number', $idNumber);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class);
    }

    /**
     * @return HasMany
     */
    public function chat(): HasMany
    {
        return $this->hasMany(Chat::class);
    }

    /**
     * @return BelongsToMany
     */
    public function consultations(): BelongsToMany
    {
        return $this->belongsToMany(Consultation::class);
    }
}
