<?php

namespace App\Http\Controllers;

use App\Models\Podcast;
use Illuminate\Http\Request;

class PodcastController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $podcasts = Podcast::with('latestEpisode')
            ->orderBy('name')
            ->paginate(20);

        return view('podcasts.index', compact('podcasts'));
    }

    public function create()
    {
        $podcast = new Podcast();
        return view('podcasts.create', compact('podcast'));
    }

    public function show(int $id)
    {
        // страницы для просмотра как таковой нет - сразу переходим в режим редакитрования
        return redirect(route('podcasts.edit', $id));
    }

    public function store(Request $request)
    {
        $podcast = Podcast::create($request->all());

        return redirect(route('podcasts.edit', $podcast));
    }

    public function edit(Podcast $podcast)
    {
        return view('podcasts.edit', compact('podcast'));
    }

    public function update(Request $request, Podcast $podcast)
    {
        $podcast->update($request->all());

        $coverFile = $request->file('cover');
        if ($coverFile) {
            $filepath = $coverFile->store('public/podcasts');
            $podcast->update(['cover_file' => $filepath]);
        }

        return redirect(route('podcasts.edit', compact('podcast')));
    }

    public function destroy(Podcast $podcast)
    {
        $podcast->delete();

        return redirect(route('podcasts.index'));
    }
}
