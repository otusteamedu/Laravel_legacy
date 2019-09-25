<?php

namespace App\Providers;

use App\Repositories\Countries\CountryRepository;
use App\Repositories\Countries\ICountryRepository;
use App\Repositories\Movies\IMovieRepository;
use App\Repositories\Movies\MovieRepository;
use App\Repositories\People\IPersonRepository;
use App\Repositories\People\PersonRepository;
use App\Repositories\Files\FileRepository;
use App\Repositories\Files\IFileRepository;
use App\Repositories\Genres\GenreRepository;
use App\Repositories\Genres\IGenreRepository;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
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
        $this->app->bind(IPersonRepository::class, PersonRepository::class);
        $this->app->bind(IFileRepository::class, FileRepository::class);
        $this->app->bind(IMovieRepository::class, MovieRepository::class);

        try {
            $fileService = new FileService(
                env('UPLOAD_FS'),
                $this->app->make(FileRepository::class)
            );
            $this->app->instance(FileService::class, $fileService);
        }
        catch (\Exception $e) {
        }
    }
}
