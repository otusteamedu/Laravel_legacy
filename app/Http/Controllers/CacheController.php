<?php

namespace App\Http\Controllers;

use App\Models\Grammar;
use Illuminate\Http\Request;
use Cache;
use DB;

class CacheController extends Controller
{
    public function index(){

        return view('cache');
    }
    public function clear(){

        Cache::flush();
        return 'Кэш очищен';
    }

    public  function clearGrammarDetail()
    {
        Cache::tags(['grammar'])->flush();
        return 'Страницы грамматики удалены из кэша';
    }

    public  function clearKey(Request $request){
        if(!empty($request->key)) {
            Cache::forget($request->key);
        }
        return 'Ключ <u>'.$request->key.'</u> удален';
    }
    public function heating()
    {
        $grammar=Grammar::all();
        Cache::put('grammar_list',$grammar,600);
        foreach ($grammar as $item){
            Grammar::find($item->id);
            Cache::tags(['grammar'])->put('grammar_detail_'.$item->id, $item, 600);
        }
        return 'Кэш прогрет';
    }
}
