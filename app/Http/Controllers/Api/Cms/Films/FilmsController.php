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
     * @OA\Get(
     *      path="/api/v1/films/",
     *      operationId="getFilms",
     *      tags={"Film"},
     *      summary="Get list of Films",
     *      description="Returns list of films",
     *  @OA\Parameter(
     *      name="limit",
     *      in="path",
     *      required=false,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="offset",
     *      in="path",
     *      required=false,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *   @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *     @OA\JsonContent(
     *        @OA\Property(property="id", type="integer", example="id film"),
     *        @OA\Property(property="title", type="string", example="title film"),
     *        @OA\Property(property="content", type="string", example="title film"),
     *        @OA\Property(property="slug", type="string", example="slug film"),
     *        @OA\Property(property="created_at", type="string", format="date-time", example="2019-02-25 12:59:20"),
     *        @OA\Property(property="count", type="integer", example="count entity"),
     *        @OA\Property(property="limit", type="integer", example="limit entity"),
     *     )
     *   ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *  )
     * ),
     *  )
     */
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
     * @OA\Post(
     *      path="/api/v1/films/",
     *      operationId="addFilm",
     *      tags={"AddFilm"},
     *      summary="Add new Film",
     *      description="Returns film",
     *  @OA\Parameter(
     *      name="limit",
     *      in="path",
     *      required=false,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="offset",
     *      in="path",
     *      required=false,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *   @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *     @OA\JsonContent(
     *        @OA\Property(property="film", type="object", ref="#/components/schemas/Film"),
     *     )
     *   ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *  )
     * ),
     *  )
     */

    /**
     * @SWG\Post(
     *     path="/api/v1/films",
     *     summary="Добавляет новый фильм",
     *     tags={"Film"},
     *     description="Добавляет новый фильм",
     *   security={
     *     {"passport": {}},
     *   },
     *   @SWG\Parameter(
     *     name="title",
     *     in="body",
     *     description="Название фильма",
     *     required=true,
     *     @SWG\Schema(type="string"),
     *      type="string",
     *   ),
     *   @SWG\Parameter(
     *      name="slug",
     *      in="body",
     *      description="Чпу (название фильма по английски)",
     *      required=true,
     *      @SWG\Schema(type="string"),
     *        type="string",
     *   ),
     *   @SWG\Parameter(
     *      name="status",
     *      in="body",
     *      description="Статус фильма (0 или 1)",
     *      required=true,
     *      @SWG\Schema(type="integer"),
     *        type="integer",
     *   ),
     *   @SWG\Parameter(
     *      name="year",
     *      in="body",
     *      description="Год фильма",
     *      required=true,
     *      @SWG\Schema(type="integer"),
     *        type="integer",
     *   ),
     *   security={
     *     {"api_key_security_example": {}},
     *   },
     *   @SWG\Response(
     *      response=200,
     *      description="successful operation",
     *      @SWG\Schema(
     *            ref="#/definitions/Film"
     *      ),
     *   ),
     *   @SWG\Response(
     *         response="401",
     *         description="Пользователь не авторизован",
     *   ),
     *   @SWG\Response(
     *         response="404",
     *         description="Метод не найден",
     *   ),
     *   @SWG\Response(
     *         response="403",
     *         description="Не передан обязательный параметр token! Либо токен истек. Либо не найден.",
     *   )
     * )
     */
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
     * @SWG\Get(
     *     path="/api/v1/films/{id}",
     *     summary="Возвращает фильм по id",
     *     tags={"Film"},
     *     description="Возвращает фильм по id",
     *   security={
     *     {"api_key_security_example": {}},
     *   },
     *   @SWG\Response(
     *      response=200,
     *      description="successful operation",
     *      @SWG\Schema(
     *            ref="#/definitions/Film"
     *      ),
     *   ),
     *   @SWG\Response(
     *         response="401",
     *         description="Пользователь не авторизован",
     *   ),
     *   @SWG\Response(
     *         response="404",
     *         description="Метод не найден",
     *   ),
     *   @SWG\Response(
     *         response="403",
     *         description="Не передан обязательный параметр token! Либо токен истек. Либо не найден.",
     *   )
     * )
     */

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
     * @param UpdateFilmRequest $request
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
