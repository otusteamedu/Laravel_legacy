<?php

namespace App\Services\Grammar\Repositories;

use App\Models\Grammar;
use DB;

class GrammarRepository
{

    public function listGrammar()
    {
        return Grammar::all();
    }

    public function detailGrammar(string $id)
    {
        return Grammar::find($id);
    }

    public function updateGrammar($data)
    {
        $id = $data['id'];

        if (Grammar::where('id', $id)->update(self::getArray($data))) {
            return $id;
        }
        return 0;
    }

    public function insertGrammar($data)
    {
        return Grammar::insertGetId(self::getArrayForInsert($data));
    }

    public function getArray($data)
    {
        $array = [];
        if (isset($data['id'])) {
            $array['id'] = $data['id'];
        }
        self::getArrayForInsert($data, $array);
        return $array;
    }

    public function getArrayForInsert($data, &$array = [])
    {

        if (isset($data['name'])) {
            $array['name'] = $data['name'];
        }
        if (isset($data['code'])) {
            $array['code'] = $data['code'];
        }
        if (isset($data['title'])) {
            $array['title'] = $data['title'];
        }
        if (isset($data['meta_keywords'])) {
            $array['meta_keywords'] = $data['meta_keywords'];
        }
        if (isset($data['meta_description'])) {
            $array['meta_description'] = $data['meta_description'];
        }
        if (isset($data['grammar_text'])) {
            $array['grammar_text'] = $data['grammar_text'];
        }
        if (isset($data['arabic_text'])) {
            $array['arabic_text'] = $data['arabic_text'];
        }
        $array['create_user_id'] = auth()->user()->id;

        return $array;
    }

}
