<?php

/*
|--------------------------------------------------------------------------
| Breadcrumbs Routes
|--------------------------------------------------------------------------
*/

Breadcrumbs::for('app_dashboard', function ($trail) {
    $trail->push(__('app.pages.dashboard'), route('app_dashboard'));
});

Breadcrumbs::for('user_profile', function ($trail) {
    $trail->parent('app_dashboard');
    $trail->push(__('app.pages.user_profile'), route('user_profile'));
});
