<?php


namespace App\Http\Controllers\Admin\Movies\Movie;

use App\Base\Controller\AbstractFormController;
use App\Helpers\Views\AdminHelpers;
use App\Models\Movie;
use App\Services\Interfaces\IMovieService;
use App\Services\Interfaces\IUploadService;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Http\Request;

class MovieFormController extends AbstractFormController
{
    protected $movieService;
    protected $uploadService;

    public function __construct(
        IMovieService $movieService,
        IUploadService $uploadService
    ) {
        $this->movieService = $movieService;
        $this->uploadService = $uploadService;
    }
    /**
     * @return View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(): View
    {
        /** @var \App\Repositories\Interfaces\IMovieRepository $repository */
        $repository = $this->movieService->getRepository();
        $this->authorize('create', Movie::class);

        $uploads = $this->uploadService->loadData();

        return view('admin.movies.create', [
            'actors' => AdminHelpers::forSelect($repository->getAvailActors()),
            'producers' => AdminHelpers::forSelect($repository->getAvailProducers()),
            'genres' => AdminHelpers::forSelect($repository->getAvailGenres()),
            'countries' => AdminHelpers::forSelect($repository->getAvailCountries()),
            'age_limits' => $repository->getAgeLimits(),
            'movieId' => 0,
            'name' => '',
            'premiere' => '',
            'slogan' => '',
            'description' => '',
            'duration' => '',
            'age_limit' => null,
            'trailer_link' => '',
            'poster' => null,
            'producer_id' => null,
            'actors_id' => [],
            'countries_id' => [],
            'genres_id' => [],
            'uploads' => isset($uploads['poster']) ? $uploads['poster'] : []
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request)
    {
        $this->authorize('store', Movie::class);
        try {
            /** @var Movie $movie */
            $movie = $this->movieService->store($request->all());
            $this->status(__('success.movies.stored', ['name' => $movie->name]));
        }
        catch (ValidationException $exception) {
            return redirect(route('admin.movies.create'))
                ->withErrors($exception->errors())
                ->withInput();
        }
        catch (Exception $exception) {
            return redirect(route('admin.movies.create'))
                ->withErrors($exception->getMessage(), 'default')
                ->withInput();
        }

        return redirect(route('admin.movies.index'));
    }
    /**
     * @param int $itemId
     * @return View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(int $itemId): View
    {
        /** @var Movie $movie */
        $movie = $this->movieService->findModel($itemId);
        $this->authorize('edit', $movie);

        /** @var \App\Repositories\Interfaces\IMovieRepository $repository */
        $repository = $this->movieService->getRepository();

        $poster = null;
        if($movie->poster) {
            $file = $this->uploadService->getFileService()->getLocalFile($movie->poster);
            if($file) {
                $poster = $movie->poster->attributesToArray();
                $poster['file_src'] = $this->uploadService->getFileService()->getAssetUrl($movie->poster);
            }
        }

        $uploads = $this->uploadService->loadData();

        return view('admin.movies.edit', [
            'model' => $movie,
            'actors' => AdminHelpers::forSelect($repository->getAvailActors()),
            'producers' => AdminHelpers::forSelect($repository->getAvailProducers()),
            'genres' => AdminHelpers::forSelect($repository->getAvailGenres()),
            'countries' => AdminHelpers::forSelect($repository->getAvailCountries()),
            'age_limits' => $repository->getAgeLimits(),
            'movieId' => $movie->id,
            'name' => $movie->name,
            'premiere' => AdminHelpers::Date_db_site($movie->premiereDate),
            'slogan' => $movie->slogan,
            'description' => $movie->description,
            'duration' => $movie->duration,
            'age_limit' => $movie->age_limit,
            'trailer_link' => $movie->trailer_link,
            'poster' => $poster,
            'producer_id' => $movie->producer_id,
            'actors_id' => $movie->actors->pluck('id')->toArray(),
            'countries_id' => $movie->countries->pluck('id')->toArray(),
            'genres_id' => $movie->genres->pluck('id')->toArray(),
            'uploads' => isset($uploads['poster']) ? $uploads['poster'] : []
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $itemId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, int $itemId)
    {
        /** @var Movie $movie */
        $movie = $this->movieService->findModel($itemId);
        $this->authorize('update', $movie);

        try {
            /** @var Movie $movie */
            $movie = $this->movieService->update($itemId,
                array_merge(['actors_id' => [], 'countries_id' => [], 'genres_id' => []], $request->all()));
            $this->status(__('success.movies.updated', ['name' => $movie->name]));
        }
        catch (ValidationException $exception) {
            redirect(route('admin.movies.edit', ['itemId' => $itemId]))
                ->withErrors($exception->errors())
                ->withInput();
        }
        catch (Exception $exception) { dd($exception->getMessage());
            redirect(route('admin.movies.edit', ['itemId' => $itemId]))
                ->withErrors($exception->getMessage(), 'default')
                ->withInput();
        }

        return redirect(route('admin.movies.index'));
    }
    /**
     * @param Request $request
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function cmdDeletePoster(Request $request) {
        /** @var Movie $movie */
        $movie = $this->movieService->findModel($request->get('itemId', 0));
        $this->authorize('update', $movie);

        $this->movieService->update($movie->id, ['poster_id' => null]);
        $this->status(__('success.movies.posterdeleted', ['name' => $movie->name]));
    }
}
