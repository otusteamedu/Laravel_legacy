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
 * @property-read bool|string $company_name
 * @property-read mixed|string $company_name_link
 * @property-read mixed|string $domain_link
 */
class Widget extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'company_id', 'domain'
    ];
    
    /**
     * Get the company this widget belongs to
     *
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class)->withTrashed();
    }
    
    /**
     * Get domain link
     *
     * @return mixed|string
     */
    public function getDomainLinkAttribute()
    {
        if ($this->trashed()) {
            return $this->domain;
        }
        
        return link_to_route('admin.widgets.edit', $this->domain, [$this->id]);
    }
    
    /**
     * Get company's name
     *
     * @return bool|string
     */
    public function getCompanyNameAttribute()
    {
        $company = $this->company;
        
        if (!$company) {
            return false;
        }
        
        return $company->name;
    }
    
    /**
     * Get company's name link
     *
     * @return mixed|string
     */
    public function getCompanyNameLinkAttribute()
    {
        $companyName = $this->company_name;
        
        if (!$companyName) {
            return '--';
        }
        
        if ($this->company->trashed()) {
            return $companyName;
        }
        
        return link_to_route('admin.companies.edit', $companyName, ['company' => $this->company]);
    }
}
