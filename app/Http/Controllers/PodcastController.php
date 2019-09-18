<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PodcastController extends Controller
{
    // temporary static data
    private const DATA = [
        [
            'id' => 1,
            'name' => 'Радио-Laravel',
            'description' => "Подкаст о Laravel!\nВыходит ежемесячно.",
            'last_episode' => [
                'no' => 34,
                'name' => 'Обзор Laravel Vaport',
            ],
        ],
        [
            'id' => 2,
            'name' => 'Радио-Symfony',
            'description' => "Подкаст о Symfony!\nВыходит еженедельно.",
            'last_episode' => [
                'no' => 112,
                'name' => 'Новинки Symfony 3.4',
            ],
        ],
        [
            'id' => 3,
            'name' => 'Радио-DevOps',
            'description' => "Всё из мира DevOps!\nДобро пожаловать.",
        ],
    ];

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('podcasts.index', ['podcasts' => self::DATA]);
    }

    public function create()
    {
        return view('podcasts.create');
    }

    public function show(int $id)
    {
        return redirect(route('podcasts.edit', $id));
    }

    public function store()
    {
        // TODO
    }

    public function edit(int $id)
    {
        $foundIndex = array_search($id, array_column(self::DATA, 'id'), false);
        if ($foundIndex === false) {
            abort(404);
        }
        return view('podcasts.edit', ['podcast' => self::DATA[$foundIndex]]);
    }

    public function update()
    {
        // TODO
    }

    public function destroy()
    {
        // TODO
    }
}
