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
 * @property int $created_user_id
 * @property int|null $widget_id
 * @property int|null $manager_id
 * @property int $lead_id
 * @property string $text
 * @property array|null $info
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Company $company
 * @property-read bool|string $company_name
 * @property-read mixed|string $company_name_link
 * @property-read int|string $id_link
 * @property-read bool|string $lead_name
 * @property-read mixed|string $lead_name_link
 * @property-read bool|mixed $manager_name
 * @property-read mixed|string $manager_name_link
 * @property-read bool|string $widget_domain
 * @property-read mixed|string $widget_domain_link
 * @property-read \App\Models\Lead $lead
 * @property-read \App\Models\User|null $manager
 * @property-read \App\Models\Widget|null $widget
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Conversation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Conversation newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Conversation onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Conversation query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Conversation whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Conversation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Conversation whereCreatedUserId($value)
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
        'company_id', 'widget_id', 'manager_id', 'lead_id', 'text', 'info', 'created_user_id'
    ];
    
    protected $casts = [
        'info' => 'array'
    ];
    
    /**
     * Get the company this conversation belongs to
     *
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class)->withTrashed();
    }
    
    /**
     * Get the widget this conversation belongs to
     *
     * @return BelongsTo
     */
    public function widget(): BelongsTo
    {
        return $this->belongsTo(Widget::class)->withTrashed();
    }
    
    /**
     * Get the manager this conversation belongs to
     *
     * @return BelongsTo
     */
    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
    
    /**
     * Get the lead this conversation belongs to
     *
     * @return BelongsTo
     */
    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class)->withTrashed();
    }
    
    /**
     * Get id link
     *
     * @return int|string
     */
    public function getIdLinkAttribute()
    {
        if ($this->trashed()) {
            return $this->id;
        }
        
        return link_to_route('admin.conversations.edit', $this->id, ['conversation' => $this]);
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
    
    /**
     * Get widget's domain
     *
     * @return bool|string
     */
    public function getWidgetDomainAttribute()
    {
        $widget = $this->widget;
        
        if (!$widget) {
            return false;
        }
        
        return $widget->domain;
    }
    
    /**
     * Get widget's domain link
     *
     * @return mixed|string
     */
    public function getWidgetDomainLinkAttribute()
    {
        $widgetDomain = $this->widget_domain;
        
        if (!$widgetDomain) {
            return '--';
        }
        
        if ($this->widget->trashed()) {
            return $widgetDomain;
        }
        
        return link_to_route('admin.widgets.edit', $widgetDomain, ['widget' => $this->widget]);
    }
    
    /**
     * Get manager's name
     *
     * @return bool|mixed
     */
    public function getManagerNameAttribute()
    {
        $manager = $this->manager;
        
        if (!$manager) {
            return false;
        }
        
        return $manager->name;
    }
    
    /**
     * Get manager's name link
     *
     * @return mixed|string
     */
    public function getManagerNameLinkAttribute()
    {
        $managerName = $this->manager_name;
        
        if (!$managerName) {
            return '--';
        }
        
        if ($this->manager->trashed()) {
            return $managerName;
        }
        
        return link_to_route('admin.users.edit', $managerName, ['user' => $this->manager]);
    }
    
    /**
     * Get lead's name
     *
     * @return bool|string
     */
    public function getLeadNameAttribute()
    {
        $lead = $this->lead;
        
        if (!$lead) {
            return false;
        }
        
        return $lead->name;
    }
    
    /**
     * Get lead's name link
     *
     * @return mixed|string
     */
    public function getLeadNameLinkAttribute()
    {
        $leadName = $this->lead_name;
        
        if (!$leadName) {
            return '--';
        }
        
        if ($this->lead->trashed()) {
            return $leadName;
        }
        
        return link_to_route('admin.leads.edit', $leadName, ['lead' => $this->lead]);
    }
}
