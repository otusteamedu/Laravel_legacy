<?php


use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::register('home', function ($breadcrumbs) {

    $breadcrumbs->push('Домой', route('home.index', ['locale'=>'ru']));

});

Breadcrumbs::for('division', function ($breadcrumbs, $division, $town_id) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($division->name, route('town', [
        'division'=>$division->id,
        'locale'=>'ru',
        'town'=>$town_id,
    ]));
});


Breadcrumbs::for('advert', function ($breadcrumbs, $advert) {
    $breadcrumbs->parent('division', $advert->division, $advert->town_id);
    $breadcrumbs->push($advert->title, route('home.show', [
        'advert'=>$advert->id,
        'locale'=>'ru',
    ]));
});
