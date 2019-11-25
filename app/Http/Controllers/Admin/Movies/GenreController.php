<?php

namespace App\Http\Controllers\Admin\Movies;

use App\Models\Genre;
use App\Repositories\Interfaces\IGenreRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GenreController extends Controller
{
    protected $genreRepository;

    public function __construct(IGenreRepository $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.genres.index', [
            'dataList' => $this->genreRepository->getList()
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.genres.create', []);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required|unique:genres,name|max:100'
        ]);
        $this->genreRepository->createFromArray($request->all());
        return redirect(route('admin.genres.index'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function edit(Genre $genre)
    {
        //
        return view('admin.genres.edit', [
            'dataItem' => $genre
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Genre $genre
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Genre $genre)
    {
        //
        $this->validate($request, [
            'name' => 'required|unique:genres,name,' . $genre->id . '|max:100'
        ]);

        $this->genreRepository->updateFromArray($genre, $request->all());
        return redirect(route('admin.genres.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre)
    {
        //
        $this->genreRepository->remove($genre);
        return redirect(route('admin.genres.index'));
    }
}
