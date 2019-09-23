<?php

use App\Models\Company;
use App\Models\Conversation;
use App\Models\Lead;
use App\Models\User;
use App\Models\Widget;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator;

/*
|--------------------------------------------------------------------------
| Breadcrumbs Routes
|--------------------------------------------------------------------------
*/

/**
 * Admin
 */
Breadcrumbs::for('admin.dashboard', function (BreadcrumbsGenerator $trail) {
    $trail->push(__('admin.pages.dashboard'), route('admin.dashboard'));
});

/**
 * Companies
 */
Breadcrumbs::for('admin.companies.index', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('admin.companies.pages.index.title'), route('admin.companies.index'));
});

Breadcrumbs::for('admin.companies.create', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.companies.index');
    $trail->push(__('admin.companies.pages.create.title'), route('admin.companies.create'));
});

Breadcrumbs::for('admin.companies.edit', function (BreadcrumbsGenerator $trail, Company $company) {
    $title = sprintf('%s "%s"', __('admin.companies.pages.edit.title'), $company->name);
    $trail->parent('admin.companies.index');
    $trail->push($title, route('admin.companies.edit', $company->id));
});

/**
 * Leads
 */
Breadcrumbs::for('admin.leads.index', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('admin.leads.pages.index.title'), route('admin.leads.index'));
});

Breadcrumbs::for('admin.leads.create', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.leads.index');
    $trail->push(__('admin.leads.pages.create.title'), route('admin.leads.create'));
});

Breadcrumbs::for('admin.leads.edit', function (BreadcrumbsGenerator $trail, Lead $lead) {
    $title = sprintf('%s "%s"', __('admin.leads.pages.edit.title'), $lead->name);
    $trail->parent('admin.leads.index');
    $trail->push($title, route('admin.leads.edit', $lead->id));
});

/**
 * Widgets
 */
Breadcrumbs::for('admin.widgets.index', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('admin.widgets.pages.index.title'), route('admin.widgets.index'));
});

Breadcrumbs::for('admin.widgets.create', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.widgets.index');
    $trail->push(__('admin.widgets.pages.create.title'), route('admin.widgets.create'));
});

Breadcrumbs::for('admin.widgets.edit', function (BreadcrumbsGenerator $trail, Widget $widget) {
    $title = sprintf('%s "%s"', __('admin.widgets.pages.edit.title'), $widget->domain);
    $trail->parent('admin.widgets.index');
    $trail->push($title, route('admin.widgets.edit', $widget->id));
});

/**
 * Users
 */
Breadcrumbs::for('admin.users.index', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('admin.users.pages.index.title'), route('admin.users.index'));
});

Breadcrumbs::for('admin.users.create', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.users.index');
    $trail->push(__('admin.users.pages.create.title'), route('admin.users.create'));
});

Breadcrumbs::for('admin.users.edit', function (BreadcrumbsGenerator $trail, User $user) {
    $title = sprintf('%s "%s"', __('admin.users.pages.edit.title'), $user->name);
    $trail->parent('admin.users.index');
    $trail->push($title, route('admin.users.edit', $user->id));
});

/**
 * Conversations
 */
Breadcrumbs::for('admin.conversations.index', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('admin.conversations.pages.index.title'), route('admin.conversations.index'));
});

Breadcrumbs::for('admin.conversations.create', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.conversations.index');
    $trail->push(__('admin.conversations.pages.create.title'), route('admin.conversations.create'));
});

Breadcrumbs::for('admin.conversations.edit', function (BreadcrumbsGenerator $trail, Conversation $conversation) {
    $title = sprintf('%s "#%s, %s"', __('admin.conversations.pages.edit.title'), $conversation->id, $conversation->created_at->format('H:i:s d.m.Y'));
    $trail->parent('admin.conversations.index');
    $trail->push($title, route('admin.conversations.edit', $conversation->id));
});
