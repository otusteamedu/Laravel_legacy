<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class AdminMenuComposer
{
    public function compose(View $view)
    {
        $mainMenuItems = [
            [
                'href' => '/',
                'title' => 'Главное',
                'route' => 'home',
            ],
        ];

        $view->with('mainMenuItems', $mainMenuItems);
    }
}
