<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Company
 *
 * @property int $id
 * @property int $created_user_id
 * @property string $name
 * @property string $email
 * @property string $url
 * @property array|null $address
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Conversation[] $conversations
 * @property-read int|null $conversations_count
 * @property-read \App\Models\User $createdUser
 * @property-read mixed|string $name_link
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Lead[] $leads
 * @property-read int|null $leads_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Widget[] $widgets
 * @property-read int|null $widgets_count
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Company onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereCreatedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Company withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Company withoutTrashed()
 * @mixin \Eloquent
 */
class Company extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name', 'email', 'url', 'address', 'created_user_id'
    ];
    
    protected $casts = [
        'address' => 'array'
    ];
    
    /**
     * List of address fields
     *
     * @return array
     */
    public static function addressFields(): array
    {
        return [
            'country'         => __('Country'),
            'city'            => __('City'),
            'postcode'        => __('Post code'),
            'street'          => __('Street'),
            'building_number' => __('Building number')
        ];
    }
    
    /**
     * Get the users belonging to this company
     *
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
    
    /**
     * Get the widgets belonging to this company
     *
     * @return HasMany
     */
    public function widgets(): HasMany
    {
        return $this->hasMany(Widget::class);
    }
    
    /**
     * Get the leads belonging to this company
     *
     * @return HasMany
     */
    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }
    
    /**
     * Get the conversations belonging to this company
     *
     * @return HasMany
     */
    public function conversations(): HasMany
    {
        return $this->hasMany(Conversation::class);
    }
    
    /**
     * Get the user that created company
     *
     * @return BelongsTo
     */
    public function createdUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_user_id')->withTrashed();
    }
    
    /**
     * Get name link
     *
     * @return mixed|string
     */
    public function getNameLinkAttribute()
    {
        if ($this->trashed()) {
            return $this->name;
        }
        
        return link_to_route('admin.companies.edit', $this->name, [$this->id]);
    }
}
