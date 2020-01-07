<?php

namespace App\Services\Orthography\Repositories;

use App\Http\Resources\OrthographyResource;
use App\Models\Orthography;
use DB;
use Cache;


class OrthographyRepository implements IOrthographyRepository
{

    public function list()
    {
        return Orthography::all('id', 'name', 'code');
    }
    public function detail(int $id)
    {
        return Orthography::find($id);
    }

    public function update(Orthography $orthography, Array $data):Orthography
    {
        $orthography->update($data);
        Cache::tags(['grammar'])->put('grammar_detail_' . $orthography->id, $data,600);
        return $orthography;
    }

    public function insert(Array $data):Orthography
    {
        $grammar = new Orthography();
        $gr= $grammar->create($data);
        Cache::tags(['grammar'])->put("grammar_detail_{$gr->id}", $gr,600);
        return $gr;
    }
}
