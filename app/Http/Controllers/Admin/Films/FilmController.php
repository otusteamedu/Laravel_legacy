<?php

namespace App\Http\Controllers\Admin\Films;
use App\Models\Film;
use View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FilmController extends Controller
{
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'slug' => 'required'
           ]);

        Film::create($request->all());

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Film  $film
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Film $film)
    {

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
