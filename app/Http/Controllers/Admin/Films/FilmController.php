<?php

namespace App\Http\Controllers\Admin\Films;

use App\Policies\Abilities;
use Gate;
use Auth;
use Log;
use Cache;
use App\Http\Controllers\Admin\Films\Requests\StoreFilmRequest;
use App\Http\Controllers\Admin\Films\Requests\UpdateFilmRequest;
use App\Models\Film;
use App\Services\Films\FilmsService;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

use Illuminate\Auth\Access\AuthorizationException;
use App\Exceptions\SimpleException;

use App\Helpers\RouteBuilder;

use View;

class FilmController extends Controller
{
    protected $filmsService;

    public function __construct(
        FilmsService $filmsService
    ) {
        $this->filmsService = $filmsService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$key = $request->user()->id . '|' . $request->getUri();
        //return Cache::remember($key, 60, function () {
        try {
            $this->authorize(Abilities::VIEW_ANY, Film::class);
        } catch (AuthorizationException $e) {
            \Log::critical('Нет прав на просмотр фильма', [
                    $this->getCurrentUser(),
                ]);
            return  abort(403, 'Нет прав на просмотр фильма', []);
        }
        return view('admin.films.index', [
                'films' => Film::paginate()
            ])->render();
        //});
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $this->authorize(Abilities::CREATE, Film::class);
        } catch (AuthorizationException $e) {
            \Log::critical('Нет прав на создание фильма', [
                $this->getCurrentUser(),
            ]);
            return  abort(403, 'Нет прав на создание фильма', []);
        }
        return view('admin.films.create');
    }

    /**
     *
     * @param StoreFilmRequest $request
     * @return void
     */
    public function store(StoreFilmRequest $request)
    {
        try {
            $this->authorize(Abilities::CREATE, Film::class);
        } catch (AuthorizationException $e) {
            \Log::critical('Нет прав на добавление фильма', [
                $this->getCurrentUser(),
            ]);
            return  abort(403, 'Нет прав на добавление фильма', []);
        }

        $lockKey = 'create-film';
        $lock = Cache::lock($lockKey, 5);
        if ($lock->get()) {
            $this->validate($request, [
                'title' => 'required|unique:films,title|max:100',
                'slug' => 'required|unique:films,slug|max:100',
            ]);
            $data = $request->all();
            $data['created_user_id'] = Auth::id();
            $film = $this->filmsService->createFilm($data);
            $lock->release();
            return redirect(RouteBuilder::localeRoute('cms.films.index'));
            //return redirect('/en/admin/films');
            //return response()->json($film, 201);
        }
        abort(422);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Film  $film
     * @return \Illuminate\Http\Response
     */
    public function edit(Film $film)
    {
        try {
            $this->authorize(Abilities::UPDATE, $film);
        } catch (AuthorizationException $e) {
            \Log::critical('Нет прав на редактирование фильма', [
                $this->getCurrentUser(),

            ]);
            return  abort(403, 'Нет прав на редактирование фильма', []);
        }
        return view('admin.films.edit', [
            'film' => $film,
        ]);
    }


    /**
     *
     * @param UpdateFilmRequest $request
     * @param Film $film
     * @return void
     */
    public function update(UpdateFilmRequest $request, Film $film)
    {
        try {
            $this->authorize(Abilities::UPDATE, $film);
        } catch (AuthorizationException $e) {
            \Log::critical('Нет прав на обновление фильма', [
                $this->getCurrentUser(),
            ]);
            return  abort(403, 'Нет прав на редактирование/обновление фильма', []);
        }

        $this->filmsService->updateFilm($film, $request->all());

        $film->update($request->all());

        return redirect(RouteBuilder::localeRoute('cms.films.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Film  $film
     * @return \Illuminate\Http\Response
     */
    public function destroy(Film $film)
    {
        try {
            $this->authorize(Abilities::DELETE, $film);
        } catch (AuthorizationException $e) {
            \Log::critical('Нет прав на удаление фильма', [
                $this->getCurrentUser(),
            ]);
            return  abort(403, 'Нет прав на удаления фильма', []);
        }
        $film->delete();
        return redirect()->back()->with('success', 'Delete Successfully');
    }

    /**
     * @return \App\Models\User|null
    */
    private function getCurrentUser()
    {
        return \Auth::user();
    }
}