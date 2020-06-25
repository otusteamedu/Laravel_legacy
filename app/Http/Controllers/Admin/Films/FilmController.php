<?php

namespace App\Http\Controllers\Admin\Films;

use App\Http\Controllers\Admin\Films\Requests\StoreFilmRequest;
use App\Http\Controllers\Admin\Films\Requests\UpdateFilmRequest;
use App\Models\Film;
use App\Services\Films\FilmsService;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

use View;


class FilmController extends Controller
{

    protected $filmsService;

    public function __construct(
        FilmsService $filmsService
    )
    {
       $this->filmsService = $filmsService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        return view('admin.films.create');
    }

    /**
     *
     * @param StoreFilmRequest $request
     * @return void
     */
    public function store(StoreFilmRequest $request)
    {
        $data = $request->getFormData();
        $this->filmsService->createFilm($data);
        return redirect(route('cms.films.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Film  $film
     * @return \Illuminate\Http\Response
     */
    public function show($film)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Film  $film
     * @return \Illuminate\Http\Response
     */
    public function edit(Film $film)
    {
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
        $film->delete();
        return redirect()->back()->with('success','Delete Successfully');
    }
}
