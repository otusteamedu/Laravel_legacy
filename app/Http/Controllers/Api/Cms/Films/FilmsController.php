<?php

namespace App\Http\Controllers\Api\Cms\Films;

use App\Http\Controllers\Api\Cms\Films\Requests\FilmsListRequest;
use App\Http\Controllers\Api\Cms\Films\Requests\StoreFilmRequest;
use App\Http\Controllers\Api\Cms\Films\Requests\UpdateFilmRequest;
use App\Http\Controllers\Api\Cms\Films\Resources\FilmsResource;
use App\Http\Controllers\Api\Cms\Films\Resources\FilmResource;
use App\Http\Controllers\Api\Cms\Films\Resources\FilmWithCommentsCountResource;
use App\Http\Controllers\Controller;
use App\Services\Films\FilmsService;
use App\Models\Film;
use App\Models\Actor;
use Illuminate\Http\Request;

class FilmsController extends Controller
{
    const MAX_PER_PAGE = 25;

    /**
     * @var FilmsService
     */
    private $filmsService;

    public function __construct(
        FilmsService $filmsService
    )
    {
        $this->filmsService = $filmsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param FilmsListRequest $request
     * @return FilmsResource
     */
    public function index(FilmsListRequest $request)
    {
        $limit = $request->getLimit();
        $offset = $request->getOffset();

        $films = $this->filmsService->getAll([], $limit, $offset);
        
        return new FilmsResource($films);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreFilmRequest $request
     * @return FilmResource
     */
    public function store(StoreFilmRequest $request)
    {
        $data = $request->all();
        $film = $this->filmsService->createFilm($data);
        return new FilmResource($film);
    }


    /**
     * @param Film $film
     * @return FilmWithCommentsCountResource
     */
    public function show(Film $film)
    {
        return new FilmWithCommentsCountResource($film);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreFilmRequest $request
     * @param  \App\Models\Film  $film
     * @return FilmResource
     */
    public function update(UpdateFilmRequest $request, Film $film)
    {
        $film = $this->filmsService->updateFilm($film, $request->all());
        return new FilmResource($film);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Film  $company
     * @return FilmResource
     */
    public function destroy(Film $film)
    {
        //так не удалиться тк есть связь фильма с актерами и жанрами
        //нужно переделать связь актеров с фильмами пока для примера так
        $film->delete();
        return new FilmResource($film);
    }
}
