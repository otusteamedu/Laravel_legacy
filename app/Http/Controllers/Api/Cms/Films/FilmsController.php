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
     *      path="/api/v1/films/{limit}{offset}",
     *      operationId="getFilms",
     *      tags={"Film"},
     *      summary="Get list of Films",
     *      description="Returns list of films",
     *      security={ {"passport": {*} }},
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
     *      path="/api/v1/films",
     *      operationId="addFilm",
     *      tags={"AddFilm"},
     *      summary="Add new Film",
     *      description="Returns film",
     *      security={ {"passport": {} }},
     * @OA\RequestBody(
     *    required=true,
     *    description="Params",
     *    @OA\JsonContent(
     *       required={"title","slug", "status", "year"},
     *       @OA\Property(property="title", type="string", example="Witcher 3"),
     *       @OA\Property(property="slug", type="string", example="witcher_3"),
     *       @OA\Property(property="status", type="string", example="0"),
     *       @OA\Property(property="year", type="string", example="2000"),
     * 
     *    ),
     * ),
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
     * @OA\Get(
     *      path="/api/v1/films/{id}",
     *      operationId="getFilm",
     *      tags={"Film"},
     *      summary="Get Film",
     *      description="Returns film",
     *      security={ {"passport": {} }},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *   @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *  @OA\JsonContent(
     *          @OA\Property(
     *           property="data",
     *           type="object",
     *           @OA\Property(
     *              property="id",
     *              type="integer",
     *              example="id film"
     *           ),
     *           @OA\Property(
     *              property="title",
     *              type="string",
     *              example="title film"
     *           ),
     *           @OA\Property(
     *              property="content",
     *              type="string",
     *              example="content film"
     *           ),
     *          @OA\Property(
     *              property="status",
     *              type="string",
     *              example="0 or 1"
     *           ),
     *          @OA\Property(
     *              property="slug",
     *              type="string",
     *              example="slug film"
     *           ),
     *          @OA\Property(
     *              property="created_at",
     *              type="string",
     *              format="date-time", 
     *              example="2019-02-25 12:59:20"
     *           ),
     *          @OA\Property(
     *              property="comments_count",
     *              type="integer",
     *              example="count comments"
     *           )
     *        )
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
     * @param Film $film
     * @return FilmWithCommentsCountResource
     */
    public function show(Film $film)
    {
        return new FilmWithCommentsCountResource($film);
    }


     /**
     * @OA\Put(
     *      path="/api/v1/films/{id}",
     *      operationId="updateFilm",
     *      tags={"Update Film"},
     *      summary="Update Film",
     *      description="Returns film",
     *      security={ {"passport": {} }},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *   @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *     @OA\JsonContent(
     *          @OA\Property(
     *           property="data",
     *           type="object",
     *           @OA\Property(
     *              property="id",
     *              type="integer",
     *              example="id film"
     *           ),
     *           @OA\Property(
     *              property="title",
     *              type="string",
     *              example="title film"
     *           ),
     *           @OA\Property(
     *              property="content",
     *              type="string",
     *              example="content film"
     *           ),
     *          @OA\Property(
     *              property="status",
     *              type="string",
     *              example="0 or 1"
     *           ),
     *          @OA\Property(
     *              property="slug",
     *              type="string",
     *              example="slug film"
     *           ),
     *          @OA\Property(
     *              property="created_at",
     *              type="string",
     *              format="date-time", 
     *              example="2019-02-25 12:59:20"
     *           ),
     *          @OA\Property(
     *              property="comments_count",
     *              type="integer",
     *              example="count comments"
     *           )
     *        )
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
     * @OA\Delete(
     *      path="/api/v1/films/{id}",
     *      operationId="deleteFilm",
     *      tags={"Delete Film"},
     *      summary="Delete Film",
     *      description="Returns film",
     *      security={ {"passport": {} }},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *   @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *     @OA\JsonContent(
     *          @OA\Property(
     *           property="data",
     *           type="object",
     *           @OA\Property(
     *              property="id",
     *              type="integer",
     *              example="id film"
     *           ),
     *           @OA\Property(
     *              property="title",
     *              type="string",
     *              example="title film"
     *           ),
     *           @OA\Property(
     *              property="content",
     *              type="string",
     *              example="content film"
     *           ),
     *          @OA\Property(
     *              property="status",
     *              type="string",
     *              example="0 or 1"
     *           ),
     *          @OA\Property(
     *              property="slug",
     *              type="string",
     *              example="slug film"
     *           ),
     *          @OA\Property(
     *              property="created_at",
     *              type="string",
     *              format="date-time", 
     *              example="2019-02-25 12:59:20"
     *           ),
     *          @OA\Property(
     *              property="comments_count",
     *              type="integer",
     *              example="count comments"
     *           )
     *        )
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
