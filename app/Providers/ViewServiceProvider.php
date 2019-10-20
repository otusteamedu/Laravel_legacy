<?php

namespace App\Providers;

use App\Http\View\Composers\MainMenuComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer(['layouts.blocks.main_menu'], MainMenuComposer::class);
    }
}
