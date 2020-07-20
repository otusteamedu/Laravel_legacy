<?php

namespace App\Http\Controllers\Admin\Films;

use App\Policies\Abilities;
use Gate;
use Auth;
use Log;
use App\Http\Controllers\Admin\Films\Requests\StoreFilmRequest;
use App\Http\Controllers\Admin\Films\Requests\UpdateFilmRequest;
use App\Models\Film;
use App\Services\Films\FilmsService;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

use Illuminate\Auth\Access\AuthorizationException;
use App\Exceptions\SimpleException;

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
        try {
            $this->authorize(Abilities::VIEW_ANY, Film::class);
        } catch (AuthorizationException $e) {
            \Log::critical('Нет прав на просмотр фильма', [
                $this->getCurrentUser(),
            ]);
            return  abort(403, 'Нет прав на просмотр фильма', []);
        }

        View::share([
            'films' => Film::paginate(),
        ]);
        return view('admin.films.index');
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
        $data = $request->getFormData();
        $this->filmsService->createFilm($data);
        return redirect(route('cms.films.index'));
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

        return redirect(route('cms.films.index'));
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