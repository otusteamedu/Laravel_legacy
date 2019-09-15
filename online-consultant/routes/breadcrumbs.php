<?php

/*
|--------------------------------------------------------------------------
| Breadcrumbs Routes
|--------------------------------------------------------------------------
*/

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push(__('admin.pages.dashboard'), route('admin.dashboard'));
});

Breadcrumbs::for('admin.user.profile', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('admin.pages.user_profile'), route('admin.user.profile'));
});
