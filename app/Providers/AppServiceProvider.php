<?php

namespace App\Providers;

use App\Repositories\Interfaces\ICountryRepository;
use App\Repositories\CountryRepository;
use App\Repositories\Interfaces\IPersonRepository;
use App\Repositories\PersonRepository;
use App\Repositories\Interfaces\IGenreRepository;
use App\Repositories\GenreRepository;

use App\Repositories\Files\FileRepository;
use App\Repositories\Files\IFileRepository;
use App\Services\FileService;

use Illuminate\Foundation\Application;
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
        // репозитории
        $this->app->bind(ICountryRepository::class, CountryRepository::class);
        $this->app->bind(IGenreRepository::class, GenreRepository::class);
        $this->app->bind(IPersonRepository::class, PersonRepository::class);
        $this->app->bind(IFileRepository::class, FileRepository::class);
        $this->app->bind(\App\Repositories\Interfaces\IMovieRepository::class, \App\Repositories\MovieRepository::class);
        $this->app->bind(\App\Repositories\Interfaces\ICinemaRepository::class, \App\Repositories\CinemaRepository::class);
        $this->app->bind(\App\Repositories\Interfaces\IUserRepository::class, \App\Repositories\UserRepository::class);
        $this->app->bind(\App\Repositories\Interfaces\IModuleRepository::class, \App\Repositories\ModuleRepository::class);
        $this->app->bind(\App\Repositories\Interfaces\IRoleRepository::class, \App\Repositories\RoleRepository::class);
        $this->app->bind(\App\Repositories\Interfaces\IUploadRepository::class, \App\Repositories\UploadRepository::class);
        $this->app->bind(\App\Repositories\Interfaces\IUserRepository::class, \App\Repositories\UserRepository::class);
        $this->app->bind(\App\Repositories\Interfaces\IRoleRepository::class, \App\Repositories\RoleRepository::class);
        $this->app->bind(\App\Repositories\Interfaces\IHallRepository::class, \App\Repositories\HallRepository::class);
        $this->app->bind(\App\Repositories\Interfaces\IMovieShowingRepository::class, \App\Repositories\MovieShowingRepository::class);

        // сервисы
        $this->app->bind(\App\Services\Interfaces\IUploadService::class, \App\Services\UploadService::class);
        $this->app->bind(\App\Services\Interfaces\IMovieService::class, \App\Services\MovieService::class);
        $this->app->bind(\App\Services\Interfaces\ICinemaService::class, \App\Services\CinemaService::class);
        $this->app->bind(\App\Services\Interfaces\IUserService::class, \App\Services\UserService::class);
        $this->app->bind(\App\Services\Interfaces\IRoleService::class, \App\Services\RoleService::class);
        $this->app->bind(\App\Services\Interfaces\IMovieShowingService::class, \App\Services\MovieShowingService::class);

        try {
            $this->app->singleton(FileService::class, function (Application $app) {
                return new FileService(
                    config('app.upload_fs'),
                    $app->make(FileRepository::class)
                );
            });
            $this->app->singleton(\App\Services\ResizeService::class);
            $this->app->singleton(\App\Services\OneSession::class, function (Application $app) {
                return new \App\Services\OneSession(
                    app('request')
                );
            });
        }
        catch (\Exception $e) {
        }
    }
}
