<?php


namespace App\Services\Cache;

use Cache;
use DB;
use App\Models\Grammar;
use App\Http\Resources\GrammarResource;
class CacheService
{
    public function clear(){
        Cache::flush();
    }
    public  function clearGrammarDetail()
    {
        Cache::tags(['grammar'])->flush();
        return 'Страницы грамматики удалены из кэша';
    }
    public  function clearKey($key){
        if(!empty($key)) {
            Cache::forget($key);
        }
    }
    public function heating()
    {
        $grammar=Grammar::all();
        Cache::put('grammar_list',$grammar,600);
        foreach ($grammar as $item){
            Grammar::find($item->id);
            Cache::tags(['grammar'])->put('grammar_detail_'.$item->id, $item, 600);
        }
    }
}
