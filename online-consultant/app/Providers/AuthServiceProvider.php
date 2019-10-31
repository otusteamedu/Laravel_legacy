<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\Conversation;
use App\Models\Lead;
use App\Models\User;
use App\Models\Widget;
use App\Policies\Companies\CompanyPolicy;
use App\Policies\Conversations\ConversationPolicy;
use App\Policies\Leads\LeadPolicy;
use App\Policies\Users\UserPolicy;
use App\Policies\Widgets\WidgetPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Company::class      => CompanyPolicy::class,
        Conversation::class => ConversationPolicy::class,
        Lead::class         => LeadPolicy::class,
        User::class         => UserPolicy::class,
        Widget::class       => WidgetPolicy::class
    ];
    
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        //
    }
}
