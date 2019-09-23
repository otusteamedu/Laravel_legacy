<?php

namespace App\Providers;

use App\Repositories\Countries\CountryRepository;
use App\Repositories\Countries\ICountryRepository;
use App\Repositories\Files\FileRepository;
use App\Repositories\Genres\GenreRepository;
use App\Repositories\Genres\IGenreRepository;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->registerBindings();
    }

    /**
     * Bootstrap any application services.
     *
     * @param Request $request
     * @return void
     */
    public function boot(Request $request)
    {
        View::share('cartCount', 1);
    }

    private function registerBindings()
    {
        $this->app->bind(ICountryRepository::class, CountryRepository::class);
        $this->app->bind(IGenreRepository::class, GenreRepository::class);


        $fileService = new FileService(config('upload.fs'), new FileRepository());
        $this->app->instance(FileService::class, $fileService);
    }
}
