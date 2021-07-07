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

    public function update(Orthography $orthography, Array $data,Array $file=[]):Orthography
    {
        foreach ($file as $key=>$f){
            $data[$key]="/img/harf/{$key}/{$data['code']}/".$f->getClientOriginalName();
            $f->move("img/harf/{$key}/{$data['code']}",$f->getClientOriginalName());
        }

        $orthography->update($data);
        Cache::tags(['orthography'])->put('orthography_detail_' . $orthography->id, $data,600);
        return $orthography;
    }

    public function insert(Array $data):Orthography
    {
        $orthography = new Orthography();
        $gr = $orthography->create($data);
        Cache::tags(['orthography'])->put("orthography_detail_{$gr->id}", $gr, 600);
        return $gr;
    }
}
